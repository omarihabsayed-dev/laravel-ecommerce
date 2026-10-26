<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();

        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::all();

        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'blog_category_id' => 'required|integer|exists:blog_categories,id',
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tag' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $fullPath = Storage::disk('public')->path($path);
            Image::decode($fullPath)
                ->cover(430, 327)
                ->save($fullPath);
            $validated['image'] = $path;
        }
        Blog::create($validated);

        return redirect()->route('blog.index')->with('success', 'Post created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::all();

        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'blog_category_id' => 'required|integer|exists:blog_categories,id',
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tag' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $fullPath = Storage::disk('public')->path($path);
            Image::decode($fullPath)
                ->cover(430, 327)
                ->save($fullPath);
            $validated['image'] = $path;
        }
        $blog->update($validated);

        return redirect()->route('blog.index')->with('success', 'Post updated successfully.');

    }

    public function destroy(Blog $blog)
    {
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Post deleted successfully.');

    }

    public function show(Blog $blog)
    {
        $categories = BlogCategory::all();

        $blogs = Blog::latest()->limit(5)->get();

        return view('frontend.blog', compact('blog', 'blogs', 'categories'));
    }

    public function posts(BlogCategory $blogCategory)
    {
        $blogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::all();
        $posts = Blog::where('blog_category_id', $blogCategory->id)
            ->latest('id')
            ->get();

        return view('frontend.home.category_posts', compact('posts', 'blogCategory', 'categories', 'blogs'));
    }

    public function home()
    {
        $blogs = Blog::latest()->get();
        $categories = BlogCategory::all();

        return view('frontend.blog_all', compact('blogs', 'categories'));

    }
}
