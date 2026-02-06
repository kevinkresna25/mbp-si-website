<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $kegiatan = Kegiatan::with('creator')
            ->when($request->search, fn($q, $s) => $q->where('nama_kegiatan', 'like', "%{$s}%"))
            ->when($request->jenis, fn($q, $j) => $q->where('jenis', $j))
            ->when($request->status, fn($q, $s) => $q->where('status', $s))
            ->orderByDesc('tanggal')
            ->paginate(15)
            ->withQueryString();

        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'jenis' => 'required|in:kajian,maulid,sosial,remaja',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|date_format:H:i',
            'lokasi' => 'nullable|string|max:255',
            'ustadz' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
        ]);

        $bannerImage = null;
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image')->store('kegiatan', 'public');
        }

        Kegiatan::create([
            ...$validated,
            'banner_image' => $bannerImage,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'jenis' => 'required|in:kajian,maulid,sosial,remaja',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|date_format:H:i',
            'lokasi' => 'nullable|string|max:255',
            'ustadz' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
        ]);

        $bannerImage = $kegiatan->banner_image;
        if ($request->hasFile('banner_image')) {
            if ($bannerImage && Storage::disk('public')->exists($bannerImage)) {
                Storage::disk('public')->delete($bannerImage);
            }
            $bannerImage = $request->file('banner_image')->store('kegiatan', 'public');
        }

        $kegiatan->update([
            ...$validated,
            'banner_image' => $bannerImage,
        ]);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->banner_image && Storage::disk('public')->exists($kegiatan->banner_image)) {
            Storage::disk('public')->delete($kegiatan->banner_image);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}
