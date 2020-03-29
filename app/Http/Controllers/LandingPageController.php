<?php

namespace App\Http\Controllers;

use App\userInfor;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingPageController extends Controller
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
    public function vietcombank()
    {
        return view('landing-page.vietcombank');
    }

    public function signUp(Request $request)
    {
        $userData = [
            'name' => $request->NAME,
            'phone' => $request->PHONE,
            'mail' => $request->Mail,
            'thunhap' => $request->thunhap,
            'hinhthucvay' => $request->hinhthucvay,
            'sotienvay' => $request->sotienvay,
        ];
        userInfor::create($userData);
        return Response::json(['msg' => 'success'], 200);
    }
}
