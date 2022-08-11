<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\User;
use TotalVoice\Client as TotalVoiceClient;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only(['email', 'password']);

        if(!auth()->attempt($credentials))
            abort(401, 'E-Mail Ou Senha Inválidos !');

        $token = auth()->user()->createToken('access_token');
        $user = User::where('id', auth()->user()->id)->with('role.permissions')->first();



        $webphone = '';
        if($user->ramal_id){
            $client = new Client();
            $r = $client->request('GET', 'https://voice-api.zenvia.com/webphone?tipo=hidden&id_ramal='.$user->ramal_id, [
                'headers' => [
                    'Access-Token' => "780e26bcd1bcc917fa0fcd0e78af8514",
                ],
            ]);
    
            $decodeR = json_decode($r->getBody()->getContents());
            $webphone = $decodeR->dados->url;
        }
        
        
        return response()->json([
            'data' => [
                'token' => $token->plainTextToken,
                "webphone" => $webphone,
                'user' => $user
            ]
        ]);
    }
}
