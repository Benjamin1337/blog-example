<?php

namespace App\Http\Controllers\Admin;

use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index ()
    {

        $users = (new User())->get();

        $params = [
            'users' => $users,
            'current' => 'users'
        ];

        return view('admin.users.index', $params);
    }
}
