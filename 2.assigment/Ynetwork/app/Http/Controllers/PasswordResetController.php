<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function create()
    {
        return view('auth.password-reset');
    }
}
