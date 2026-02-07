<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\VideoCeramah;
use Illuminate\Http\Request;

class VideoCeramahController extends Controller
{
    public function index(Request $request)
    {
        $videos = VideoCeramah::with('creator')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('ustadz', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        return view('public.video-ceramah.index', compact('videos'));
    }

    public function show(VideoCeramah $videoCeramah)
    {
        $videoCeramah->load('creator');

        $relatedVideos = VideoCeramah::where('id', '!=', $videoCeramah->id)
            ->latest()
            ->take(3)
            ->get();

        return view('public.video-ceramah.show', compact('videoCeramah', 'relatedVideos'));
    }
}
