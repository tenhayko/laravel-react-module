<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function test()
    {
        return view('test');
    }
    public function deleteImage()
    {
        return response()->json(['message'=>'ok','status' => 200], 200);
    }
    public function upload(Request $request)
    {
        $path   = $request->file('file')->store('public/avatars');
        $url    = Storage::url($path);
        return response()->json(['secure_url'=>$url,'status' => 200], 200);
    }
    public function authenticate()
    {
        echo 'string';
    }
}
