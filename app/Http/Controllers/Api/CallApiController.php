<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Call;
use Illuminate\Http\Request;

class CallApiController extends Controller
{
    public function index()
    {
        return Call::all();
    }

    public function show(Call $call)
    {
        return $call;
    }

    public function store(Request $request)
    {
        $request->validate([
            'caller' => 'required',
            'receiver' => 'required',
            'duration' => 'required|integer',
            'date' => 'required|date',
        ]);

        $call = Call::create($request->all());
        return response()->json($call, 201);
    }

    public function update(Request $request, Call $call)
    {
        $request->validate([
            'caller' => 'required',
            'receiver' => 'required',
            'duration' => 'required|integer',
            'date' => 'required|date',
        ]);

        $call->update($request->all());
        return response()->json($call, 200);
    }

    public function destroy(Call $call)
    {
        $call->delete();
        return response()->json(null, 204);
    }
}
