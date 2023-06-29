<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $perPage = 10;
        $categories = Category::paginate($perPage);

        return view('administrator.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $user = auth()->user();
        if($user->can('administrator')) {
            return view('administrator.categories.show', compact('category'));
        } else {
            abort(403, 'Forbidden');
        }
    }

    public function create()
    {
        return view('administrator.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories',
            'description' => 'nullable',
        ]);

        $category = new Category([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('administrator.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {   
        $category = Category::findOrFail($category->id);

        $validatedData = $request->validate([
            'name' => [
                'required',
                Rule::unique('categories')->ignore($category->id),
            ],
            'description' => 'nullable',
        ]);
    
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
