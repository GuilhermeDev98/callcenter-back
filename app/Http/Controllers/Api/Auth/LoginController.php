<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only(['email', 'password']);

        if(!auth()->attempt($credentials))
            abort(401, 'E-Mail Ou Senha Inválidos !');

        $token = auth()->user()->createToken('access_token');

        return response()->json([
            'data' => [
                'token' => $token->plainTextToken,
                'user' => auth()->user()
            ]
        ]);
    }
}
