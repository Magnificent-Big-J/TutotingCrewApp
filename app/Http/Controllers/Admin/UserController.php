<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function saveUserData(UserRequest $request)
    {
        $request->createUser();

        session()->flash('success', 'User is successfully created.');
    }

}
