<?php

namespace Modules\Chat\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    /**
     * Get list User.
     * @return Response
     */
    public function getList()
    {
        return User::with('userInfo')->get();
    }
}
