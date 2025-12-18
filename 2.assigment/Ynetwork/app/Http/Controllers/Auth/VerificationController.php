<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

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
}
