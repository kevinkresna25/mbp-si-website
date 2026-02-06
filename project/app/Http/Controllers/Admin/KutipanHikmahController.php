<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KutipanHikmah;
use Illuminate\Http\Request;

class KutipanHikmahController extends Controller
{
    public function index()
    {
        $kutipans = KutipanHikmah::orderByDesc('created_at')
            ->paginate(15);

        return view('admin.kutipan-hikmah.index', compact('kutipans'));
    }

    public function create()
    {
        return view('admin.kutipan-hikmah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kutipan_text' => 'required|string|max:2000',
            'sumber' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        KutipanHikmah::create([
            'kutipan_text' => $validated['kutipan_text'],
            'sumber' => $validated['sumber'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.kutipan-hikmah.index')
            ->with('success', 'Kutipan hikmah berhasil ditambahkan.');
    }

    public function edit(KutipanHikmah $kutipanHikmah)
    {
        return view('admin.kutipan-hikmah.edit', compact('kutipanHikmah'));
    }

    public function update(Request $request, KutipanHikmah $kutipanHikmah)
    {
        $validated = $request->validate([
            'kutipan_text' => 'required|string|max:2000',
            'sumber' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $kutipanHikmah->update([
            'kutipan_text' => $validated['kutipan_text'],
            'sumber' => $validated['sumber'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.kutipan-hikmah.index')
            ->with('success', 'Kutipan hikmah berhasil diperbarui.');
    }

    public function destroy(KutipanHikmah $kutipanHikmah)
    {
        $kutipanHikmah->delete();

        return redirect()->route('admin.kutipan-hikmah.index')
            ->with('success', 'Kutipan hikmah berhasil dihapus.');
    }
}
