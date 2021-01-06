<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }
}
