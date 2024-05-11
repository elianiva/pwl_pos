<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GoodsModel;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function index()
    {
        return GoodsModel::all();
    }

    public function store(Request $request)
    {
        $level = GoodsModel::create($request->all());
        return response()->json($level, 201);
    }

    public function show(GoodsModel $level)
    {
        return GoodsModel::find($level);
    }

    public function update(Request $request, GoodsModel $level)
    {
        $level->update($request->all());
        return GoodsModel::find($level);
    }

    public function destroy(GoodsModel $level)
    {
        $level->delete();
        return response()->json([
            'success' => true,
            'message' => 'Level deleted successfully',
        ]);
    }
}
