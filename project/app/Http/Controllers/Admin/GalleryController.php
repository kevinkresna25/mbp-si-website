<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $galleries = Gallery::with(['uploader', 'media'])
            ->when($request->category, fn($q, $c) => $q->where('category', $c))
            ->orderByDesc('tanggal')
            ->paginate(12)
            ->withQueryString();

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|in:kegiatan,pembangunan,umum',
            'tanggal' => 'required|date',
            'photos' => 'required|array|min:1',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $gallery = Gallery::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'],
            'tanggal' => $validated['tanggal'],
            'uploaded_by' => auth()->id(),
        ]);

        foreach ($request->file('photos') as $photo) {
            $gallery->addMedia($photo)->toMediaCollection('photos');
        }

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil ditambahkan dengan ' . count($request->file('photos')) . ' foto.');
    }

    public function show(Gallery $gallery)
    {
        $gallery->load('media');
        return view('admin.galleries.show', compact('gallery'));
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->clearMediaCollection('photos');
        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }
}
