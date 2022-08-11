<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function store(Request $request){
        $team = Team::create($request->all());
        
        return response()->json([
            'message' => 'Time Criado Com Sucesso!',
            'data' => $team
        ]);
    }

    public function show(Request $request){
        $team = Team::where('id', $request->team)->with(['supervisor', 'employees'])->first();

        return response()->json([
            'data' => $team
        ]);
    }

    public function editEmployees(Team $team, Request $request){
        $team->employees()->sync($request->employees);

        return response()->json([
            'data' => $team->load(['supervisor', 'employees'])
        ]);
    }
}
