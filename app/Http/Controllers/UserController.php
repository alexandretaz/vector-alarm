<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select()->paginate();

        return view('user.list', ['users'=>$users]);
    }

    public function edit($userId)
    {
        $user = User::
    }

}
