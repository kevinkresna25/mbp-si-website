<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaticPageController extends Controller
{
    public function index()
    {
        $pages = StaticPage::with('updater')->get();

        return view('admin.static-pages.index', compact('pages'));
    }

    public function edit(StaticPage $staticPage)
    {
        return view('admin.static-pages.edit', compact('staticPage'));
    }

    public function update(Request $request, StaticPage $staticPage)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $validated['updated_by'] = Auth::id();

        $staticPage->update($validated);

        return redirect()->route('admin.static-pages.index')
            ->with('success', "Halaman '{$staticPage->title}' berhasil diperbarui.");
    }
}
