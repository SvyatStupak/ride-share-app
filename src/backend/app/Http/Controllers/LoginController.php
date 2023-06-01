<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\LoginNeedsVerfication;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function submit(Request $request) {
        $request->validate([
            'phone' => 'required|numeric|min:10',
        ]);

        $user = User::firstOrCreate([
            'phone' => $request->phone,
        ]);

        if(!$user) {
            return response()->json([
                'message' => 'Could not process a user with that phone number',
            ], 404);
        }

        $user->notify(new LoginNeedsVerfication());

        return response()->json([
            'message' => 'Text message notification sent',
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|min:10',
            'login_code' => 'required|numeric|between:111111,999999',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if ($user) {
            $user->update(['login_code' => null]);

            return $user->createToken($request->login_code)->plainTextToken;
        }

        return response()->json([
            'message' => 'Invalid verivication code.',
        ], 404);
    }
}
