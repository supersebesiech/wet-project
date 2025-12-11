<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Laravel\Pail\ValueObjects\Origin\Console;

class SessionController extends Controller
{
    public function create()
    {

        return view('auth.login');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)]
        ]);

        if (!Auth::attempt($attributes, true)) {
            throw ValidationException::withMessages([
                'password' => 'Provided email or password are incorrect.'
            ]);
        }

        request()->session()->regenerate();
        error_log('entered store method');

        // Return JSON response for AJAX request
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['success' => true]);
        }

        // Fallback for non-AJAX requests
        return redirect('/for-you');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
