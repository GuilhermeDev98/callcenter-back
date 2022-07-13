<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Memo;

class MemoController extends Controller
{

    public function search(Request $request){
        $memos = Memo::where('attendance_id', $request->atenndance)->with('creator')->orderBy('created_at', 'desc')->get();
        return response()->json($memos);
    }

    public function store(Request $request){
        $memo = Memo::create($request->all());
        return response()->json($memo, 201);
    }
}
