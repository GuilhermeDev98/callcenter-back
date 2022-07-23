<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only(['email', 'password']);

        if(!auth()->attempt($credentials))
            abort(401, 'E-Mail Ou Senha Inválidos !');

        $token = auth()->user()->createToken('access_token');
        $user = User::where('id', auth()->user()->id)->with('role.permissions')->first();



        return response()->json([
            'data' => [
                'token' => $token->plainTextToken,
                'user' => $user
            ]
        ]);
    }
}
