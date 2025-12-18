<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function verify(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $user = User::findOrFail($request->id);

        if (! hash_equals(sha1($user->getEmailForVerification()), $request->hash)) {
            abort(403);
        }

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        return redirect('/');
    }

    public function verifyNewEmail(Request $request)
    {
        abort_unless($request->hasValidSignature(), 403);

        $user = User::findOrFail($request->id);

        abort_unless($user->new_email && hash_equals(sha1($user->new_email), $request->email), 403);

        $user->forceFill([
            'email' => $user->new_email,
            'new_email' => null,
            'email_verified_at' => now(),
        ])->save();

        Auth::logout();

        return redirect('/');
    }
}
