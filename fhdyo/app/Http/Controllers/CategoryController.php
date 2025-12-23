<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with('questions','results')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category'=>'required|string',
            'description'=>'nullable|string',
        ]);

        return Category::create($data);
    }

    public function show(Category $category)
    {
        return $category->load('questions','results');
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'category'=>'string',
            'description'=>'nullable|string',
        ]);

        $category->update($data);
        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message'=>'Category deleted']);
    }
}
