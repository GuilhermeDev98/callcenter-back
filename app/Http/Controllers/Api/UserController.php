<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use TotalVoice\Client as TotalVoiceClient;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $userData = $request->all();

        $userData['password'] = bcrypt($request->email);

        if (!$user = $user->create($userData))
            abort(500, 'Erro ao Criar Um Novo Usuário');
        
        
        if($request->sector){
            $roleUser = Role::where('id', $request->sector)->first();

            $user->role()->associate($roleUser);
            $user->save();
        }

        if($request->createRamal){

            // Cria Ramal na Totalvoice
            $client = new TotalVoiceClient('780e26bcd1bcc917fa0fcd0e78af8514');
            $dados = [
                "login"=> $request->email,
                "gravar_audio" => true,
                "ligacao_celular" => true,
                "ligacao_externa" => true
            ];
            $client->central->criarRamal($dados);
        }
        
        return response()->json([
            'message' => 'Usuário Criado Com Sucesso!',
            'data' => $user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([], 200);
    }

    public function associateRole(User $user, Role $role){
        $user->role()->associate($role);
        $user->save();
    }
}
