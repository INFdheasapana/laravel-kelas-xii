<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();

        return view('admin.users', compact('users'));
    }
}