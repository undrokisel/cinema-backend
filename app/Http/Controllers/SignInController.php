<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;


class SignInController extends Controller
{


    public function sign_in(Request $request)
    {
        $credentials = $request->only('login', 'password');
        try {
            if (!Auth::attempt($credentials)) {
                throw ValidationException::withMessages([
                    'login' => ['These credentials do not match our records.'],
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            if ($user instanceof User) {
               
                $token = $user->createToken('authToken')->plainTextToken;
                return response()->json([
                    'token' => $token,
                    'name' => $user->name,
                    'surname' => $user->surname,
                    'email' => $user->email,
                    'login' => $user->login,
                    'patronimic' => $user->patronimic,
                    'is_admin' => $user->is_admin,
                ], 200);
            } else {
            }
        }
        // Authentication failed...
        return response()->json(['error' => 'Invalid credentials'], 401);
    }



}
