<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function doctors()
    {
        return response()->json(
        \App\Models\User::where('role', 'doctor')
            ->get(['id', 'name'])
    );
    }
}
