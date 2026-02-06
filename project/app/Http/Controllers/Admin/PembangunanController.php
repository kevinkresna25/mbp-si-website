<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PembangunanFase;
use Illuminate\Http\Request;

class PembangunanController extends Controller
{
    public function index()
    {
        $fases = PembangunanFase::with(['updater', 'media'])
            ->orderBy('order_column')
            ->get();

        $overallProgress = PembangunanFase::getOverallProgress();

        return view('admin.pembangunan.index', compact('fases', 'overallProgress'));
    }

    public function create()
    {
        return view('admin.pembangunan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_fase' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:2000',
            'target_selesai' => 'nullable|date',
            'progress_persen' => 'required|integer|min:0|max:100',
            'status' => 'required|in:not_started,in_progress,completed',
            'order_column' => 'nullable|integer|min:0',
        ]);

        $validated['updated_by'] = auth()->id();
        $validated['order_column'] = $validated['order_column'] ?? PembangunanFase::max('order_column') + 1;

        PembangunanFase::create($validated);

        return redirect()->route('admin.pembangunan.index')
            ->with('success', 'Fase pembangunan berhasil ditambahkan.');
    }

    public function edit(PembangunanFase $pembangunan)
    {
        $pembangunan->load('media');

        return view('admin.pembangunan.edit', compact('pembangunan'));
    }

    public function update(Request $request, PembangunanFase $pembangunan)
    {
        $validated = $request->validate([
            'nama_fase' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:2000',
            'target_selesai' => 'nullable|date',
            'progress_persen' => 'required|integer|min:0|max:100',
            'status' => 'required|in:not_started,in_progress,completed',
            'order_column' => 'nullable|integer|min:0',
        ]);

        $validated['updated_by'] = auth()->id();

        $pembangunan->update($validated);

        return redirect()->route('admin.pembangunan.index')
            ->with('success', 'Fase pembangunan berhasil diperbarui.');
    }

    public function uploadPhotos(Request $request, PembangunanFase $pembangunan)
    {
        $request->validate([
            'photos' => 'required|array|min:1',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        foreach ($request->file('photos') as $photo) {
            $pembangunan->addMedia($photo)->toMediaCollection('progress_photos');
        }

        return redirect()->route('admin.pembangunan.edit', $pembangunan)
            ->with('success', count($request->file('photos')) . ' foto progress berhasil diupload.');
    }

    public function uploadMasterplan(Request $request, PembangunanFase $pembangunan)
    {
        $request->validate([
            'masterplan' => 'required|array|min:1',
            'masterplan.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        foreach ($request->file('masterplan') as $file) {
            $pembangunan->addMedia($file)->toMediaCollection('masterplan');
        }

        return redirect()->route('admin.pembangunan.edit', $pembangunan)
            ->with('success', 'Gambar masterplan berhasil diupload.');
    }

    public function deleteMedia(PembangunanFase $pembangunan, int $mediaId)
    {
        $media = $pembangunan->media()->where('id', $mediaId)->firstOrFail();
        $media->delete();

        return redirect()->route('admin.pembangunan.edit', $pembangunan)
            ->with('success', 'Media berhasil dihapus.');
    }

    public function destroy(PembangunanFase $pembangunan)
    {
        $pembangunan->clearMediaCollection('masterplan');
        $pembangunan->clearMediaCollection('progress_photos');
        $pembangunan->delete();

        return redirect()->route('admin.pembangunan.index')
            ->with('success', 'Fase pembangunan berhasil dihapus.');
    }
}
