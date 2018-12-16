<?php

namespace Modules\Chat\Http\Controllers;

use \Pusher\Pusher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
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
