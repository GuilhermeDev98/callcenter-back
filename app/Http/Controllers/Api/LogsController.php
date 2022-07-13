<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;

class LogsController extends Controller
{
    public function index(Request $request){
        $logs = Log::with(['user'])->get();

        return response()->json([
            'data' => $logs
        ], 200);
    }
}
