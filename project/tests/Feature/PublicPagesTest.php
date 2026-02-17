<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\StaticPage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_keuangan_page_loads(): void
    {
        $response = $this->get('/keuangan');
        $response->assertStatus(200);
    }

    public function test_donasi_page_loads(): void
    {
        $response = $this->get('/keuangan/donasi');
        $response->assertStatus(200);
    }

    public function test_artikel_page_loads(): void
    {
        $response = $this->get('/artikel');
        $response->assertStatus(200);
    }

    public function test_kontak_page_loads(): void
    {
        $response = $this->get('/kontak');
        $response->assertStatus(200);
    }

    public function test_profil_sejarah_loads(): void
    {
        $response = $this->get('/profil/sejarah');
        $response->assertStatus(200);
    }

    public function test_profil_visi_misi_loads(): void
    {
        $response = $this->get('/profil/visi-misi');
        $response->assertStatus(200);
    }

    public function test_profil_struktur_loads(): void
    {
        $response = $this->get('/profil/struktur');
        $response->assertStatus(200);
    }

    public function test_profil_lokasi_loads(): void
    {
        $response = $this->get('/profil/lokasi');
        $response->assertStatus(200);
    }

    public function test_kegiatan_page_loads(): void
    {
        $response = $this->get('/kegiatan');
        $response->assertStatus(200);
    }

    public function test_kegiatan_kalender_loads(): void
    {
        $response = $this->get('/kegiatan/kalender');
        $response->assertStatus(200);
    }

    public function test_belajar_islam_syahadat_loads(): void
    {
        $response = $this->get('/belajar-islam/syahadat');
        $response->assertStatus(200);
    }

    public function test_belajar_islam_sholat_loads(): void
    {
        $response = $this->get('/belajar-islam/sholat');
        $response->assertStatus(200);
    }

    public function test_belajar_islam_mengaji_loads(): void
    {
        $response = $this->get('/belajar-islam/mengaji');
        $response->assertStatus(200);
    }

    public function test_layanan_jadwal_salat_loads(): void
    {
        $response = $this->get('/layanan/jadwal-salat');
        $response->assertStatus(200);
    }

    public function test_layanan_nikah_loads(): void
    {
        StaticPage::create(['key' => 'layanan_nikah', 'title' => 'Layanan Nikah', 'content' => '<p>Test</p>']);
        $response = $this->get('/layanan/nikah');
        $response->assertStatus(200);
    }

    public function test_layanan_konsultasi_loads(): void
    {
        $response = $this->get('/layanan/konsultasi');
        $response->assertStatus(200);
    }

    public function test_layanan_permohonan_loads(): void
    {
        StaticPage::create(['key' => 'layanan_permohonan', 'title' => 'Permohonan Fasilitas', 'content' => '<p>Test</p>']);
        $response = $this->get('/layanan/permohonan');
        $response->assertStatus(200);
    }

    public function test_pembangunan_page_loads(): void
    {
        $response = $this->get('/pembangunan');
        $response->assertStatus(200);
    }

    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_register_page_loads(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }
}
