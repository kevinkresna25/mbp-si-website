<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Display the contact page with form, social media links, and pengurus contacts.
     */
    public function index()
    {
        $pengurus = [
            [
                'nama' => 'H. Sudirman',
                'jabatan' => 'Ketua Takmir',
                'wa' => '6281234567800',
            ],
            [
                'nama' => 'Ir. Bambang Sutrisno',
                'jabatan' => 'Wakil Ketua',
                'wa' => '6281234567801',
            ],
            [
                'nama' => 'Drs. Ahmad Syafii',
                'jabatan' => 'Sekretaris',
                'wa' => '6281234567802',
            ],
            [
                'nama' => 'Hj. Siti Aisyah',
                'jabatan' => 'Bendahara',
                'wa' => '6281234567803',
            ],
        ];

        $socialMedia = [
            ['platform' => 'Instagram', 'url' => 'https://instagram.com/masjidbukit.palma', 'handle' => '@masjidbukit.palma'],
            ['platform' => 'YouTube', 'url' => 'https://youtube.com/@masjidbukit.palma', 'handle' => 'Masjid Bukit Palma'],
            ['platform' => 'Facebook', 'url' => 'https://facebook.com/masjidbukit.palma', 'handle' => 'Masjid Bukit Palma'],
        ];

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
            'pesan' => 'required|string|max:5000',
            // Turnstile validation placeholder
            // 'cf-turnstile-response' => 'required',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('public.kontak.index')
            ->with('success', 'Pesan Anda berhasil dikirim. Terima kasih telah menghubungi kami!');
    }
}
