<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('administrator.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('administrator.categories.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan form

        $category = new Category([
            'name' => $request->name,
        ]);

        $category->save();

        return redirect()->route('administrator.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('administrator.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Validasi inputan form

        $category->name = $request->name;
        $category->save();

        return redirect()->route('administrator.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('administrator.categories.index')->with('success', 'Category deleted successfully.');
    }
}
