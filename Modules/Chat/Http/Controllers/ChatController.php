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
use Modules\Chat\Traits\MessageTrait;
use Modules\Chat\Entities\Conversation;
use Modules\Chat\Entities\MBOConversation;

class ChatController extends Controller
{
    /**
     * Traits
     */
    use MessageTrait;
    /**
     * Pusher
     */
    private $APP_KEY = 'b7a1e4b0955d704d953c';
    private $APP_SECRET = 'e329ea5ade45144307f6';
    private $APP_ID = '673416';
    private $pusher;
    /**
     * 
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->pusher = new Pusher($this->APP_KEY, $this->APP_SECRET, $this->APP_ID, [
            'cluster' => 'ap2',
            'encrypted' => true
        ]);
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

    public function firebase()
    {
        $this->sendGCM('aloooo', 'fZw1mPcEloE:APA91bGwat2lXuCTUOSHG_ofYUmLkWJTZbKnqk6C_69gDz4mhZ6Yu4tjJuBjnv7m6G5_3ncaStds_NiVa19WxTJdFsEIkqwb-CelBtcfT0DYO5THXfzdTn8qaUUH5jJsvNYwtOravtIQ');
        // return view('chat::firebase');
    }

    public function pushmesage(Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        $this->sendGCM('aloooo', $request->tokenCMS);
    }
    public function sendGCM($message, $id) {


        $url = 'https://fcm.googleapis.com/fcm/send';
    
        $fields = array (
                'registration_ids' => array (
                        $id
                ),
                'data' => array (
                        "body" => 'helloooooooooooo',
                        "icon" => 'https://ngaoo.com/images/ngaoo-logo.png',
                        "link" => 'https://ngaoo.com/firebase'
                )
        );
        $fields = json_encode ( $fields );
    
        $headers = array (
                'Authorization: key=' . "AAAA-3prNxQ:APA91bFhKCcGEuAFIsLn7BU3jV845PC-DZZlbtpVirwnG2-1PLKe_QgYBZVHrJ-3covq2afn1fR9GyoYmP0WF_3PNFQFfQ9l7dme9SNzr24YSBDU9r7zo6ONpsxT8dj4AMyDHLYQAteC",
                'Content-Type: application/json'
        );
    
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
    
        $result = curl_exec ( $ch );
        echo $result;
        curl_close ( $ch );
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
            $conversation = $this->buildConversation($conversation);
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
        $user = Auth::guard('web')->user();
        $channelName = 'channel-chat';
        $message = $user->messages()->create([
            'messages' => $request->input('messages'),
            'conversation_id' => $request->input('conversation_id')
        ]);
        $conversation = Conversation::where('id',$request->input('conversation_id'))->first();
        $data['user_id'] = $user->id;
        $data['messages'] = $request->input('messages');
        $data['conversation_id'] = $request->input('conversation_id');
        $data['conversation_user'] = $conversation->user;
        $userConversation = MBOConversation::where('conversation_id', $request->input('conversation_id'))->whereNotIn('user_id',[$user->id])->get();
        if($userConversation){
            foreach($userConversation as $value){
                $this->pusher->trigger('channel-chat', 'user-'.$value->user_id, $data);
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
        $presence_data = ['name'=>auth()->user()->name];
        $key = $this->pusher->presence_auth($channelName, $socketId, auth()->id(), $presence_data);
        return response($key);
    }
}
