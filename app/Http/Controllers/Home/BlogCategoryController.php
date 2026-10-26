<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::all();

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
        ]);

        BlogCategory::create($validated);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function edit(BlogCategory $BlogCategory)
    {
        return view('admin.category.edit', compact('BlogCategory'));
    }

    public function update(Request $request, BlogCategory $BlogCategory)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
        ]);
        $BlogCategory->update($validated);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(BlogCategory $BlogCategory)
    {
        $BlogCategory->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');

    }
}
