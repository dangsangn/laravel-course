<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignupControlller extends Controller
{
    public function create() {
        return view('auth.signup');
    }
}
