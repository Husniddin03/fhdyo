<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'category' => 'required|string',
            'description' => 'nullable|string',
            'questions' => 'nullable|array',
            'questions.*' => 'required|string',
        ]);

        $category = Category::create([
            'category' => $data['category'],
            'description' => $data['description'] ?? null,
        ]);
        if (isset($data['questions'])) {
            foreach ($data['questions'] as $questionData) {
                Question::create([
                    'category_id' => $category->id,
                    'question' => $questionData,
                ]);
            }
        }
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function show(Category $category)
    {
        return $category->load('questions', 'results');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'category'    => 'required|string',
            'description' => 'nullable|string',
            'questions'   => 'nullable|array',
            'questions.*' => 'required|string',
        ]);

        // Category update
        $category->update([
            'category'    => $data['category'],
            'description' => $data['description'] ?? null,
        ]);

        // Savollarni yangilash
        if (isset($data['questions'])) {
            // Eski savollarni o‘chirib tashlaymiz
            $category->questions()->delete();

            // Yangi savollarni qo‘shamiz
            foreach ($data['questions'] as $questionData) {
                Question::create([
                    'category_id' => $category->id,
                    'question'    => $questionData,
                ]);
            }
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
