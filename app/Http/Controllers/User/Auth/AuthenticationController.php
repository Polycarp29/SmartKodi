<?php

namespace App\Http\Controllers\User\Auth;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    //

    public function login(){
        return Inertia::render('AuthPage');

    }


    public function register(){

    }
}
