<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        if(!$attributes = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]))
        {
            throw ValidationException::withMessages([
                'password' => 'Provided email or password are incorrect.'
            ]);
        };

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/for-you');
    }
}
