<?php

namespace App\Http\Controllers\v1;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'users' => User::all(),
            'status' => 'success',
            'message' => 'Retrieved Users Successfully'
        ]);
    }
}
