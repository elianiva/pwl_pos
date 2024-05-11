<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryModel::all();
    }

    public function store(Request $request)
    {
        $level = CategoryModel::create($request->all());
        return response()->json($level, 201);
    }

    public function show(CategoryModel $level)
    {
        return CategoryModel::find($level);
    }

    public function update(Request $request, CategoryModel $level)
    {
        $level->update($request->all());
        return CategoryModel::find($level);
    }

    public function destroy(CategoryModel $level)
    {
        $level->delete();
        return response()->json([
            'success' => true,
            'message' => 'Level deleted successfully',
        ]);
    }
}
