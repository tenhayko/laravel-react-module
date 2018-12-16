<?php

namespace Modules\Chat\Http\Controllers;

use \Pusher\Pusher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Chat\Entities\Message;
use Illuminate\Support\Facades\Auth;
use Modules\Chat\Events\MessageSent;

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
    return Message::with('user')->get();
    }

    /**
     * 
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $channelName = 'channel-chat';
        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);
        $pusher = new Pusher('b7a1e4b0955d704d953c', 'e329ea5ade45144307f6', '673416', [
            'cluster' => 'ap2',
            'encrypted' => true
        ]);
        $data['message'] = 'hello world';
        $pusher->trigger('channel-chat', 'new-message', $data);
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
