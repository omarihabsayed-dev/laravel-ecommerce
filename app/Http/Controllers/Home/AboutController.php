<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::FindOrFail(1);

        return view('admin.about.index', compact('about'));
    }

    public function update(Request $request)
    {
        $about = About::findOrFail(1);

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'short_title' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'long_description' => 'nullable|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('about_image')) {
            if ($about->about_image) {
                Storage::disk('public')->delete($about->about_image);
            }
            $path = $request->file('about_image')->store('images', 'public');
            $fullPath = Storage::disk('public')->path($path);
            Image::decode($fullPath)
                ->cover(523, 605)
                ->save($fullPath);

            $validated['about_image'] = $path;
        }

        $about->update($validated);

        return redirect()->route('about.index')->with('success', 'About section updated successfully.');
    }

    public function show()
    {
        $about = About::FindOrFail(1);

        return view('frontend.about', compact('about'));
    }

    public function multiImages()
    {
        $images = MultiImage::get();

        return view('admin.about.multi_images', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'multi_image' => 'required',
            'multi_image.*' => 'image|mimes:jpeg,png,jpg|',
        ]);

        $multiImage = MultiImage::FindOrFail(1);
        $paths = [];

        if ($request->hasFile('multi_image')) {
            $oldImages = $multiImage->multi_image;
            if (is_array($oldImages)) {
                foreach ($oldImages as $oldImg) {
                    Storage::disk('public')->delete($oldImg);
                }
            }

            foreach ($request->file('multi_image') as $image) {
                $path = $image->store('images', 'public');
                $fullPath = Storage::disk('public')->path($path);

                Image::decode($fullPath)
                    ->cover(220, 220)
                    ->save($fullPath);

                $paths[] = $path; // Add to array
            }

            $multiImage->update([
                'multi_image' => $paths,
            ]);
        }

        return redirect()->route('about.multi-images')->with('success', 'Multi images updated successfully.');
    }
}
