<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logs;

class LogsController extends Controller
{
    public function index(Request $request){
        $logs = Logs::with(['user'])->get();

        return response()->json([
            'data' => $logs
        ], 200);
    }
}
