<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class PortfolioController extends Controller
{
    public function index()
    {
        $protfolios = Portfolio::latest()->get();

        return view('admin.portfolio.index', compact('protfolios'));
    }

    public function update(Request $request)
    {
        $portfolio = Portfolio::FindOrFail(1);
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            if ($portfolio->image) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $fullPath = Storage::disk('public')->path($path);
            Image::decode($fullPath)
                ->cover(1020, 519)
                ->save($fullPath);

            $validated['image'] = $path;
        }
        $portfolio->update($validated);

        return redirect()->route('portfolio.index')->with('success', 'Portfolio updated successfully.');
    }

    public function show()
    {
        $portfolio = Portfolio::findOrFail(1);

        return view('frontend.portfolio', compact('portfolio'));
    }
}
