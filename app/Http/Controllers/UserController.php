<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    public function __invoke()
    {
        // $users = User::select('id', 'name', 'email', 'phone')->get();
        $users = collect();

        $statuses = (new UserService())->get_identification_status($users);

        return view('statuses', compact('statuses'));
    }
}
