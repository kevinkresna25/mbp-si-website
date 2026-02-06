<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturController extends Controller
{
    public function index()
    {
        $struktur = Struktur::all();

        return view('admin.struktur.index', compact('struktur'));
    }

    public function create()
    {
        return view('admin.struktur.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'jabatan'      => 'required|string|max:255',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'kontak'       => 'nullable|string|max:255',
            'order_column' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        $validated['order_column'] = $validated['order_column'] ?? Struktur::withoutGlobalScope('ordered')->max('order_column') + 1;

        Struktur::create($validated);

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Anggota struktur berhasil ditambahkan.');
    }

    public function edit(Struktur $struktur)
    {
        return view('admin.struktur.edit', compact('struktur'));
    }

    public function update(Request $request, Struktur $struktur)
    {
        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'jabatan'      => 'required|string|max:255',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'kontak'       => 'nullable|string|max:255',
            'order_column' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            // Delete old foto
            if ($struktur->foto) {
                Storage::disk('public')->delete($struktur->foto);
            }
            $validated['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        $struktur->update($validated);

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Anggota struktur berhasil diperbarui.');
    }

    public function destroy(Struktur $struktur)
    {
        if ($struktur->foto) {
            Storage::disk('public')->delete($struktur->foto);
        }

        $struktur->delete();

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Anggota struktur berhasil dihapus.');
    }

    /**
     * Reorder struktur via AJAX.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:struktur,id',
        ]);

        foreach ($request->order as $position => $id) {
            Struktur::withoutGlobalScope('ordered')
                ->where('id', $id)
                ->update(['order_column' => $position]);
        }

        return response()->json(['success' => true]);
    }
}
