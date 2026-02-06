<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoCeramah;
use Illuminate\Http\Request;

class VideoCeramahController extends Controller
{
    public function index()
    {
        $videos = VideoCeramah::with('creator')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.video-ceramah.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.video-ceramah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'video_url' => 'required|url|max:500',
            'ustadz' => 'nullable|string|max:255',
            'durasi' => 'nullable|string|max:50',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('video-ceramah/thumbnails', 'public');
        }

        VideoCeramah::create([
            'judul' => $validated['judul'],
            'video_url' => $validated['video_url'],
            'ustadz' => $validated['ustadz'] ?? null,
            'durasi' => $validated['durasi'] ?? null,
            'thumbnail' => $thumbnailPath,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.video-ceramah.index')
            ->with('success', 'Video ceramah berhasil ditambahkan.');
    }

    public function edit(VideoCeramah $videoCeramah)
    {
        return view('admin.video-ceramah.edit', compact('videoCeramah'));
    }

    public function update(Request $request, VideoCeramah $videoCeramah)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'video_url' => 'required|url|max:500',
            'ustadz' => 'nullable|string|max:255',
            'durasi' => 'nullable|string|max:50',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $thumbnailPath = $videoCeramah->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($thumbnailPath && \Storage::disk('public')->exists($thumbnailPath)) {
                \Storage::disk('public')->delete($thumbnailPath);
            }
            $thumbnailPath = $request->file('thumbnail')->store('video-ceramah/thumbnails', 'public');
        }

        $videoCeramah->update([
            'judul' => $validated['judul'],
            'video_url' => $validated['video_url'],
            'ustadz' => $validated['ustadz'] ?? null,
            'durasi' => $validated['durasi'] ?? null,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('admin.video-ceramah.index')
            ->with('success', 'Video ceramah berhasil diperbarui.');
    }

    public function destroy(VideoCeramah $videoCeramah)
    {
        if ($videoCeramah->thumbnail && \Storage::disk('public')->exists($videoCeramah->thumbnail)) {
            \Storage::disk('public')->delete($videoCeramah->thumbnail);
        }

        $videoCeramah->delete();

        return redirect()->route('admin.video-ceramah.index')
            ->with('success', 'Video ceramah berhasil dihapus.');
    }
}
