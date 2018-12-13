<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
class AdminLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin::auth.admin-login');
    }
    protected function guard(){
        return Auth::guard('admin');
    }
    
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * You can overwrite the login method
     */
    // public function login(Request $req)
    // {
    //     $this->validate($req,[
    //         'email'=>'required|email',
    //         'password'=>'required|min:6',
    //     ]);
    //     if (Auth::guard('admin')->attempt(['email'=>$req->email, 'password'=>$req->password], $req->remember)) {
    //         return redirect()->intended(route('admin'));
    //     }
    //     return redirect()->back()->withInput($req->only('email', 'remember'));
    // }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}