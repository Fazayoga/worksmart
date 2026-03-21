<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgotPassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        // For now, since reset link logic depends on mail configuration, 
        // we'll just redirect back with a status message.
        
        return back()->with('status', 'Instruksi reset password telah dikirim ke email Anda (Simulasi).');
    }
}
