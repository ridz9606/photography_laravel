<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Client;

class AuthController extends Controller
{
    // 🔹 Common OTP function
   private function generateOtp($email, $type)
{
    $otp = rand(100000, 999999);

    DB::table('otps')->updateOrInsert(
        ['email' => $email, 'type' => $type],
        [
            'otp' => $otp,
            'expires_at' => now()->addMinutes(5),
            'created_at' => now(),
            'updated_at' => now()
        ]
    );

    return $otp;
}
    
    
    // 🔹 Forgot Password
    public function sendForgotOtp(Request $request)
{
    $client = Client::where('email', $request->email)->first();

    if (!$client) { // ✅ FIXED
        return response()->json(['message' => 'Email not registered']);
    }

    $otp = $this->generateOtp($request->email, 'forgot');

    return response()->json([
        'message' => 'OTP Sent Successfully',
        'otp' => $otp
    ]);
}

public function resetPassword(Request $request)
{
    $record = DB::table('otps')
        ->where('email', $request->email)
        ->where('otp', $request->otp)
        ->where('type', 'forgot')
        ->first();

    if (!$record || now()->gt($record->expires_at)) {
        return response()->json(['message' => 'Invalid or expired OTP']);
    }

    Client::where('email', $request->email)->update([
        'password' => bcrypt($request->password)
    ]);

    return response()->json(['message' => 'Password reset successful']);
}
}
