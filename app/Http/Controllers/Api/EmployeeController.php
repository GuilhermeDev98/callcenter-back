<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;

class EmployeeController extends Controller
{
    public function index(){
        $employees = User::where('role_id', '!=', 'null')->with('role')->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($employees);
    }
}
