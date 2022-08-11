<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    public function index(){
        $employees = User::where('role_id', '!=', 'null')->with('role', 'team.supervisor')->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($employees);
    }

    public function delete(User $user)
    {
        $user->delete();
        return response()->json([], 200);
    }

    public function show(User $user){
        return response()->json($user->load('role', 'team.supervisor'));
    }
}
