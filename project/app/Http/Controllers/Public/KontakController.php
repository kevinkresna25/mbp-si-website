<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Struktur;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KontakController extends Controller
{
    /**
     * Display the contact page with form, social media links, and pengurus contacts.
     */
    public function index()
    {
        $pengurus = Struktur::select('nama', 'jabatan', 'kontak')
            ->orderBy('order_column')
            ->get()
            ->map(fn ($s) => [
                'nama' => $s->nama,
                'jabatan' => $s->jabatan,
                'wa' => $s->kontak,
            ])
            ->toArray();

        $socialMedia = SocialLink::allActive();

        return view('public.kontak.index', compact('pengurus', 'socialMedia'));
    }

    /**
     * Store a new contact message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'pesan' => 'required|string|min:20|max:5000',
            'cf-turnstile-response' => 'required',
        ], [
            'pesan.min' => 'Pesan minimal 20 karakter.',
            'cf-turnstile-response.required' => 'Verifikasi CAPTCHA diperlukan.',
        ]);

        // Verify Turnstile token
        $turnstileResponse = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => config('services.turnstile.secret_key'),
            'response' => $request->input('cf-turnstile-response'),
            'remoteip' => $request->ip(),
        ]);

        if (!$turnstileResponse->json('success')) {
            return back()->withErrors(['cf-turnstile-response' => 'Verifikasi CAPTCHA gagal. Silakan coba lagi.'])->withInput();
        }

        // Remove turnstile field before creating
        unset($validated['cf-turnstile-response']);

        ContactMessage::create($validated);

        return redirect()->route('public.kontak.index')
            ->with('success', 'Pesan Anda berhasil dikirim. Terima kasih telah menghubungi kami!');
    }
}
