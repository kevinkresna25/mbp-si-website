<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = SocialLink::orderBy('sort_order')->get();
        return view('admin.social-links.index', compact('links'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string',
            'label' => 'nullable|string',
            'url' => 'required|url',
            'icon' => 'nullable|string',
        ]);

        // Auto-set label if empty
        if (empty($validated['label'])) {
            $validated['label'] = $validated['platform'] === 'Custom' ? 'Link' : $validated['platform'];
        }

        // Set order to last
        $validated['sort_order'] = SocialLink::max('sort_order') + 1;

        SocialLink::create($validated);

        return back()->with('success', 'Media sosial berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialLink $socialLink)
    {
        $validated = $request->validate([
            'platform' => 'required|string',
            'label' => 'nullable|string',
            'url' => 'required|url',
            'icon' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $socialLink->update($validated);

        return back()->with('success', 'Media sosial berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return back()->with('success', 'Media sosial berhasil dihapus');
    }

    /**
     * Reorder links.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:social_links,id',
        ]);

        foreach ($request->ids as $index => $id) {
            SocialLink::where('id', $id)->update(['sort_order' => $index]);
        }

        cache()->forget('social_links_active');

        return response()->json(['message' => 'Urutan berhasil diperbarui']);
    }
}
