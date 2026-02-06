<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Enums\CategoryZiswaf;
use App\Models\DonationTarget;
use Illuminate\Http\Request;

class DonationTargetController extends Controller
{
    /**
     * Display a listing of donation targets.
     */
    public function index()
    {
        $targets = DonationTarget::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.donation-targets.index', compact('targets'));
    }

    /**
     * Show the form for creating a new donation target.
     */
    public function create()
    {
        $categories = CategoryZiswaf::cases();

        return view('admin.donation-targets.create', compact('categories'));
    }

    /**
     * Store a newly created donation target.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_ziswaf' => 'required|in:' . implode(',', array_column(CategoryZiswaf::cases(), 'value')),
            'target_amount' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'description' => 'nullable|string|max:1000',
        ], [
            'name.required' => 'Nama target donasi wajib diisi.',
            'target_amount.required' => 'Target nominal wajib diisi.',
            'target_amount.min' => 'Target nominal minimal Rp 1.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'end_date.after' => 'Tanggal selesai harus setelah tanggal mulai.',
        ]);

        DonationTarget::create($validated);

        return redirect()->route('admin.donation-targets.index')
            ->with('success', 'Target donasi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing a donation target.
     */
    public function edit(DonationTarget $donationTarget)
    {
        $categories = CategoryZiswaf::cases();

        return view('admin.donation-targets.edit', compact('donationTarget', 'categories'));
    }

    /**
     * Update the specified donation target.
     */
    public function update(Request $request, DonationTarget $donationTarget)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_ziswaf' => 'required|in:' . implode(',', array_column(CategoryZiswaf::cases(), 'value')),
            'target_amount' => 'required|numeric|min:1',
            'current_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => 'required|in:active,completed,paused',
            'description' => 'nullable|string|max:1000',
        ]);

        $donationTarget->update($validated);

        return redirect()->route('admin.donation-targets.index')
            ->with('success', 'Target donasi berhasil diperbarui.');
    }

    /**
     * Remove the specified donation target.
     */
    public function destroy(DonationTarget $donationTarget)
    {
        $donationTarget->delete();

        return redirect()->route('admin.donation-targets.index')
            ->with('success', 'Target donasi berhasil dihapus.');
    }
}
