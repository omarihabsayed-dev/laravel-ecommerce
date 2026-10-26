<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class HomeSlidesController extends Controller
{
    public function index()
    {
        $slides = HomeSlide::FindOrFail(1);

        return view('admin.home-slides.index', compact('slides'));
    }

    public function update(Request $request)
    {
        $slides = HomeSlide::FindOrFail(1);

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'video_url' => 'nullable|url|max:255',
            'homepage_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('homepage_image')) {
            if ($slides->homepage_image) {
                Storage::disk('public')->delete($slides->homepage_image);
            }
            $path = $request->file('homepage_image')->store('images', 'public');
            $fullPath = Storage::disk('public')->path($path);
            Image::decode($fullPath)
                ->cover(636, 852)
                ->save($fullPath);
            $validated['homepage_image'] = $path;
        }

        $slides->update($validated);

        return redirect()->route('home-slides.index')->with('success', 'Home slides updated successfully.');
    }
}
