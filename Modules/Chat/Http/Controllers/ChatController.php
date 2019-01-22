<?php

namespace Modules\Chat\Http\Controllers;

use App\User;
use \Pusher\Pusher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Chat\Entities\Message;
use Modules\Chat\Entities\Conversation;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
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
    public function fetchMessages()
    {
        $conversation = $this->getMessage();
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
            $conversation = Conversation::with(['member'=>function($query){
                $query->with(['user'=>function($q){
                    $q->with('userInfo');
                }]);
            }])->first();
        }
        if($conversation){
            $conversation->members = $conversation->member->keyBy('id');
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
            // echo 'create new conversation';
        }
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
        $data['user_id'] = $user->id;
        $data['messages'] = $request->input('messages');
        $data['conversation_id'] = $request->input('conversation_id');
        $pusher->trigger('channel-chat', 'new-message-'.$request->input('conversation_id'), $data);
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
