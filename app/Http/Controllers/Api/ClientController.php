<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\User;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $client = Client::where('registration', $request->registration)->with('user')->first();

        return response()->json($client, 200);
    }

    public function store(Request $request)
    {
        //Verifica se CPF já foi cadastrado
        $searchClient = Client::where('cpf', $request->cpf)->first();
        if ($searchClient) {
            return response()->json([
                'message' => 'CPF Já Cadastrado!'
            ], 400);
        }

        //Verifica se Email já foi cadastrado
        $searchUser = User::where('email', $request->contact_email)->first();

        if ($searchUser) {
            return response()->json([
                'message' => 'E-Mail Já Cadastrado!'
            ], 400);
        } else {

            $user = [
                'name' => $request->full_name,
                'email' => $request->contact_email,
                'password' => 'secret',
            ];

            $user = User::create($user);

            $request['user_id'] = $user->id;

            $client = Client::create($request->all());
            return response()->json([
                'data' => $client
            ], 201);
        }

        return response()->json([
            'message' => 'Erro Desconhecido',
        ], 400);
    }

    public function showLogs(Request $request)
    {
        $client = Client::where('registration', $request->registration)->with('logs')->first();
        return response()->json($client, 200);
    }

    public function search(Request $request)
    {


        $clients = Client::select('*')
            ->where('registration', $request->search)
            ->orWhere('cpf', $request->search)
            ->get();


        return response()->json($clients, 200);
    }

    public function showAttendances(Request $request)
    {
        $attendances = Client::where('registration', $request->registration)->with('attendances.creator')->first();
        return response()->json($attendances, 200);
    }
}
