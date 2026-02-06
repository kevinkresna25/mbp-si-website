<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\ArtikelController;
use App\Http\Controllers\Public\BelajarIslamController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\KegiatanController;
use App\Http\Controllers\Public\KeuanganController;
use App\Http\Controllers\Public\KontakController;
use App\Http\Controllers\Public\LayananController;
use App\Http\Controllers\Public\PembangunanController;
use App\Http\Controllers\Public\ProfilController;
use Illuminate\Support\Facades\Route;

// ─── Public Homepage ─────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// ─── Public Profil Routes ────────────────────────────────────────────────────
Route::get('/profil/sejarah', [ProfilController::class, 'sejarah'])->name('profil.sejarah');
Route::get('/profil/visi-misi', [ProfilController::class, 'visiMisi'])->name('profil.visi-misi');
Route::get('/profil/struktur', [ProfilController::class, 'strukturOrganisasi'])->name('profil.struktur');
Route::get('/profil/lokasi', [ProfilController::class, 'lokasi'])->name('profil.lokasi');

// ─── Public Artikel Routes ───────────────────────────────────────────────────
Route::get('/artikel', [ArtikelController::class, 'index'])->name('public.artikel.index');
Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])->name('public.artikel.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Google OAuth Routes
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

// ─── Public Keuangan Routes ────────────────────────────────────────────────────
Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
Route::get('/keuangan/donasi', [KeuanganController::class, 'donasi'])->name('keuangan.donasi');
Route::get('/keuangan/laporan/{year}/{month}/pdf', [KeuanganController::class, 'laporanPdf'])->name('keuangan.laporan.pdf');

// ─── Public Pembangunan Routes ────────────────────────────────────────────────
Route::get('/pembangunan', [PembangunanController::class, 'index'])->name('public.pembangunan.index');

// ─── Public Kegiatan Routes ────────────────────────────────────────────────────
Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('public.kegiatan.index');
Route::get('/kegiatan/kalender', [KegiatanController::class, 'kalender'])->name('public.kegiatan.kalender');
Route::get('/kegiatan/{id}', [KegiatanController::class, 'show'])->name('public.kegiatan.show');

// ─── Public Layanan Routes ─────────────────────────────────────────────────────
Route::get('/layanan/jadwal-salat', [LayananController::class, 'jadwalSalat'])->name('public.layanan.jadwal-salat');
Route::get('/layanan/nikah', [LayananController::class, 'nikah'])->name('public.layanan.nikah');
Route::get('/layanan/konsultasi', [LayananController::class, 'konsultasi'])->name('public.layanan.konsultasi');
Route::get('/layanan/permohonan', [LayananController::class, 'permohonan'])->name('public.layanan.permohonan');

// ─── Public Belajar Islam Routes ────────────────────────────────────────────────
Route::get('/belajar-islam/syahadat', [BelajarIslamController::class, 'syahadat'])->name('belajar-islam.syahadat');
Route::get('/belajar-islam/sholat', [BelajarIslamController::class, 'sholat'])->name('belajar-islam.sholat');
Route::get('/belajar-islam/mengaji', [BelajarIslamController::class, 'mengaji'])->name('belajar-islam.mengaji');

// ─── Public Kontak Routes ──────────────────────────────────────────────────────
Route::get('/kontak', [KontakController::class, 'index'])->name('public.kontak.index');
Route::post('/kontak', [KontakController::class, 'store'])->name('public.kontak.store')->middleware('throttle:contact');

require __DIR__.'/auth.php';
