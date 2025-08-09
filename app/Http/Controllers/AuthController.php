<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    // app/Http/Controllers/AuthController.php
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'wallet_address' => 'required|string|min:48|unique:users',
            'referrer_id' => 'nullable|string|exists:users,id',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if referrer exists if provided
        $referrer = null;
        if ($request->referrer_id) {
            $referrer = User::find($request->referrer_id);
            if (!$referrer) {
                return response()->json([
                    'message' => 'Invalid referrer ID',
                    'errors' => ['referrer_id' => ['Referrer not found']]
                ], 422);
            }
        }

        // Create user
        $user = User::create([
            'email' => $request->email,
            'wallet_address' => $request->wallet_address,
            'referrer_id' => $request->referrer_id,
            'password' => Hash::make($request->password),
        ]);

        // Optionally create initial payment record
        Payment::create([
            'user_id' => $user->id,
            'type' => 'earning',
            'amount' => 0.00000050,
        ]);

        // If there's a referrer, give them a bonus
        if ($referrer) {
            Payment::create([
                'user_id' => $referrer->id,
                'type' => 'referral_bonus',
                'amount' => 0.00001000, // Example referral bonus
            ]);
        }

        return response()->json([
            'message' => 'Registration successful',
            'user' => $user->makeHidden(['password'])
        ], 201);
    }
}
