<?php

namespace Modules\Admin\Http\Controllers;

use Response;
use App\userInfor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserInforController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function listUser()
    {
    	$userInfor = userInfor::all()->sortByDesc('id');
    	return view('admin::page.user', ["userInfor"=>$userInfor]);
    }

    public function editUser(Request $request)
    {
    	$id = $request->id;
    	$data = [
    		'name' => $request->name,
    		'phone' => $request->phone,
    		'mail' => $request->mail,
    		'hinhthucvay' => $request->hinhthucvay,
    		'sotienvay' => $request->sotienvay,
    		'status' => $request->status,
    		'note' => $request->note,
    	];
    	userInfor::findOrFail($id)->update($data);
    	return Response::json(['msg' => 'success'], 200);
    }
}