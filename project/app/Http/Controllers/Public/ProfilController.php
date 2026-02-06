<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use App\Models\Struktur;

class ProfilController extends Controller
{
    public function sejarah()
    {
        $page = StaticPage::where('key', 'sejarah')->first();

        return view('public.profil.sejarah', compact('page'));
    }

    public function visiMisi()
    {
        $page = StaticPage::where('key', 'visi_misi')->first();

        return view('public.profil.visi-misi', compact('page'));
    }

    public function strukturOrganisasi()
    {
        $struktur = Struktur::all(); // already ordered by global scope

        return view('public.profil.struktur', compact('struktur'));
    }

    public function lokasi()
    {
        $page = StaticPage::where('key', 'lokasi')->first();

        return view('public.profil.lokasi', compact('page'));
    }
}
