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
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('chat::index');
    }

    /**
     * 
     */
    public function chat()
    {
        return view('chat::chat');
    }

    /**
     * 
     */
    public function fetchMessages()
    {
        $conversation = Conversation::with(['member'=>function($query){
            $query->with(['user'=>function($q){
                $q->with('userInfo');
            }]);
        }])->first();
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
        return $conversation;
    }

    /**
     * 
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
    * 
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
