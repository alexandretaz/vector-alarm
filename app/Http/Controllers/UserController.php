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

    public function add()
    {
        $user = new User();
        $user->profile = json_decode($user->profile);
        return view('user.form', ['user'=>$user]);
    }

    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        $user->profile = json_decode($user->profile);
        return view('user.form', ['user'=>$user]);
    }

    public function store (Request $request)
    {
        $userId = $request->input('id', null);
        if(!empty($userId)) {
            $user = User::findOrFail($userId);
        }
        else{
            $user = new User();

        }
        $data = $request->toArray();
        $jsonProfile = \json_encode($data['profile']);
        unset($data['profile']);
        unset($data['_token']);
        unset($data['password_confirmation']);
        $profile = new \StdClass();
        foreach($data as $att=>$value) {
            $user->$att = $value;
        }
        $user->profile = $jsonProfile;
        $user->save();
        return redirect()->route('users');
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect()->route('users');
    }

}
