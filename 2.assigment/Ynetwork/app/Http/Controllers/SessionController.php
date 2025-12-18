<?php

namespace App\Http\Controllers;

use App\Mail\Authentification;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function authentificationView(){
        return view('auth.2fa-auth');
    }

    public function send(){
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required',Password::min(8)]
        ]);
        $user = Auth::getProvider()->retrieveByCredentials($attributes);
        if (!$user || !Auth::getProvider()->validateCredentials($user, $attributes)) {
            throw ValidationException::withMessages([
                'password' => 'Provided email or password are incorrect.'
            ]);
        }

        if (!$user->hasVerifiedEmail()) {
            throw ValidationException::withMessages([
                'password' => 'Please verify your email adress.'
            ]);
        }

        $code = $user->generateCode();

        Mail::to($user->email)->send(new Authentification($user, $code));

        Auth::logout();
        session(['2faUser' => $user->id]);

        return redirect('/authentification');
    }

    public function store(Request $request){
        $request->validate([
            'code' => 'required',
        ]);
        $user = User::find(session('2faUser'));
        if (!$user || !Hash::check($request->code, $user->two_fa_code) || $user->two_fa_code_expires_at < now()) {
            throw ValidationException::withMessages([
                'code' => ['The two factor authentication code is invalid or expired.'],
            ]);
        }
        $user->resetCode();
        Auth::login($user);
        request()->session()->regenerate();

        return redirect('/for-you');
    }

    public function destroy(){
        Auth::logout();
        return redirect('/');
    }
}
