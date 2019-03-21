<?php

namespace Modules\Chat\Http\Controllers;

use App\User;
use Carbon\Carbon;
use \Pusher\Pusher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Chat\Entities\Message;
use Illuminate\Support\Facades\Auth;
use Modules\Chat\Entities\Conversation;
use Modules\Chat\Entities\MBOConversation;

class ChatController extends Controller
{
    /**
     * 
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @author: tenhayko
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('chat::index');
    }

    /**
     * @author: tenhayko
     */
    public function chat()
    {
        return view('chat::chat');
    }

    /**
     *  @author: tenhayko
     */
    public function fetchMessages($conversation_id = false)
    {
        $conversation = $this->getMessage($conversation_id);
        if($conversation)
        return $conversation;
        return response()->json(['message'=>'Not found','status' => 404], 404);
    }

    /**
     * @author: tenhayko
     * Get message of conversation
     */
    public function getMessage($conversation_id = false)
    {
        if($conversation_id){
            $conversation = Conversation::with(['member'=>function($query){
                $query->with(['user'=>function($q){
                    $q->with('userInfo');
                }]);
            }])->whereId($conversation_id)->first();
        }else{
            $user_id = Auth::guard('web')->user()->id;
            $conversation = Conversation::select('conversations.*')->with(['member'=>function($query){
                $query->with(['user'=>function($q){
                    $q->with('userInfo');
                }]);
            }])->join('m_b_o_conversations', 'conversations.id', '=', 'm_b_o_conversations.conversation_id')->where('m_b_o_conversations.user_id',$user_id)->first();
        }
        if($conversation){
            $conversation->members = $conversation->member->keyBy('user_id');
            unset($conversation->member);
            $message = [];
            $user_id = false;
            $i = 0;
            foreach ($conversation->messages as $key => $value) {
                if ($user_id && $user_id == $value->user_id) {
                    $message [$i]['user_id'] = $value->user_id;
                    $message [$i]['message'][] = $value->toArray();
                }else{
                    if(array_key_exists($i,$message))
                    $i++;
                    $user_id = $value->user_id;
                    $message [$i]['user_id'] = $value->user_id;
                    $message [$i]['message'][] = $value->toArray();
                }
            }
            unset($conversation->messages);
            $conversation->messages = $message;
        }
        return $conversation;
    }

    /**
     * @author: tenhayko
     * Get or Create conversation
     */
    public function getConversation(Request $request)
    {
        if($request->conversation_id)
        {
            return $this->getMessage($request->conversation_id);
        }else{
            $user_id = Auth::guard('web')->user()->id;
            $friend_id = $request->user_id;
            if($friend_id)
            {
                $conversation           = new Conversation;
                $conversation->type     = 0;
                $conversation->status   = 1;
                $conversation->title    = 'title';
                $conversation->save();
                $conversation->member()->create([
                    'user_id' => $user_id
                ]);
                $conversation->member()->create([
                    'user_id' => $friend_id
                ]);
                $conversation->user()->create([
                    'user_one' => $user_id,
                    'user_two' => $friend_id
                ]);
                return response()->json(['conversation'=>$conversation->user,'message'=>$this->getMessage($conversation->id),'status' => 200], 200);
            }
        }
        return response()->json(['message'=>'Not found','status' => 404], 404);
    }

    /**
     * @author: tenhayko
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $channelName = 'channel-chat';
        $message = $user->messages()->create([
            'messages' => $request->input('messages'),
            'conversation_id' => $request->input('conversation_id')
        ]);
        $pusher = new Pusher('b7a1e4b0955d704d953c', 'e329ea5ade45144307f6', '673416', [
            'cluster' => 'ap2',
            'encrypted' => true
        ]);
        $conversation = Conversation::where('id',$request->input('conversation_id'))->first();
        $data['user_id'] = $user->id;
        $data['messages'] = $request->input('messages');
        $data['conversation_id'] = $request->input('conversation_id');
        $data['conversation_user'] = $conversation->user;
        $userConversation = MBOConversation::where('conversation_id', $request->input('conversation_id'))->whereNotIn('user_id',[$user->id])->get();
        if($userConversation){
            foreach($userConversation as $value){
                $pusher->trigger('channel-chat', 'user-'.$value->user_id, $data);
            }
        }
        return ['status' => 'Message Sent!'];
    }

    /**
    * @author: tenhayko
    */
    public function authenticate(Request $request)
    {
        $socketId = $request->socket_id;
        $channelName = $request->channel_name;
        $pusher = new Pusher('b7a1e4b0955d704d953c', 'e329ea5ade45144307f6', '673416', [
            'cluster' => 'ap2',
            'encrypted' => true
        ]);
        $presence_data = ['name'=>auth()->user()->name];
        $key = $pusher->presence_auth($channelName, $socketId, auth()->id(), $presence_data);
        return response($key);
    }
}
