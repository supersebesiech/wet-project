<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

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
            'email' => ['required', 'email', 'unique:users', 'confirmed'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'birthdate' => ['required', 'date', 'before_or_equal:' . Carbon::now()->subYears(18)->toDateString(),
    ],
        ]))
        {
            throw ValidationException::withMessages([
            ]);
        };

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/for-you');
    }
}
