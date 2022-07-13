<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Log;
use Illuminate\Support\Str;


class AttendanceController extends Controller
{

    public function index(Request $request){
        $attendances = Attendance::with(['creator', 'client'])->get();

        return response()->json([
            'data' => $attendances
        ], 200);
    }

    public function store(Request $request){
        $attendance = Attendance::create($request->all());

        return response()->json([
            'data' => $attendance
        ], 201);
    }

    public function update(Attendance $Attendance, Request $request){
        $Attendance->status = $request->status;
        $Attendance->forwarding = $request->forwarding;
        $Attendance->save();
        
        return response()->json($Attendance);
    }

    public function generateAttendanceUUID(){
        return (string) Str::uuid();
    }
}
