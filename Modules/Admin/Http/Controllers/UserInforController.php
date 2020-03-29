<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class UserInforController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function listUser()
    {
    	return view('admin::page.user');
    }
}