<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ATMController extends Controller
{
    public function test(){
        $users = User::get();
        return response()->json($users);
    }
}
