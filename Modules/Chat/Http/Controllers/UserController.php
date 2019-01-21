<?php

namespace Modules\Chat\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Get list User.
     * @return Response
     */
    public function getList()
    {
        $user_id = Auth::guard('web')->user()->id;
        return User::with(['userInfo','conversationUser'])->where('id','<>',$user_id)->get();
    }
}
