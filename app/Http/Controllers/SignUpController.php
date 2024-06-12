<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\CyrillicSpaceDashRule;
use App\Rules\LatinSpaceDashRule;
use Illuminate\Support\Facades\Validator;


class SignUpController extends Controller
{
    public function store(Request $request)
    {

        $rules = [
            'name' => ["bail", "required", "string", "max:255", new CyrillicSpaceDashRule],
            'surname' => ["bail", "required", "string", "max:255", new CyrillicSpaceDashRule],
            'patronymic' => ["bail", "nullable", "string", "max:255", new CyrillicSpaceDashRule],
            'login' => ["bail", "required", "unique:users", "string", "max:255", new LatinSpaceDashRule],
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|string|min:6',
            'agreement' => 'bail|accepted',
        ];

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $user = new User();
        $user->fill([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'patronymic' => $request->input('patronymic'),
            'login' => $request->input('login'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        $user->save();

        $token = $user->createToken('authToken')->plainTextToken;
        
        return response()->json(['token' => $token], 201);
    }
}
