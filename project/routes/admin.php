<?php

use App\Http\Controllers\Admin\ApprovalController;
use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DonationTargetController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\KutipanHikmahController;
use App\Http\Controllers\Admin\PembangunanController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\PrayerTimeController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\StaticPageController;
use App\Http\Controllers\Admin\StrukturController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoCeramahController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

// ─── Financial Module ──────────────────────────────────────────────────────────

// Transactions (bendahara & admin)
Route::middleware('role:bendahara|admin')->group(function () {
    Route::get('/transactions', [TransactionController::class , 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class , 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class , 'store'])->name('transactions.store');
    Route::get('/transactions/{transaction}/edit', [TransactionController::class , 'edit'])->name('transactions.edit');
    Route::patch('/transactions/{transaction}/submit', [TransactionController::class , 'submit'])->name('transactions.submit');
    Route::delete('/transactions/{transaction}', [TransactionController::class , 'destroy'])->name('transactions.destroy');
});

// Approval (takmir_inti & admin)
Route::middleware('role:takmir_inti|admin')->group(function () {
    Route::get('/approval', [ApprovalController::class , 'index'])->name('approval.index');
});

// Donation Targets (bendahara, takmir_inti & admin)
Route::middleware('role:bendahara|takmir_inti|admin')->group(function () {
    Route::resource('donation-targets', DonationTargetController::class)->except(['show']);
});

// ─── Profile & Homepage Module ─────────────────────────────────────────────────

// Struktur Organisasi (takmir_inti & admin)
Route::middleware('role:takmir_inti|admin')->group(function () {
    Route::resource('struktur', StrukturController::class)->except(['show']);
    Route::post('/struktur/reorder', [StrukturController::class , 'reorder'])->name('struktur.reorder');
});

// Pengumuman (takmir_inti & admin)
Route::middleware('role:takmir_inti|admin')->group(function () {
    Route::resource('pengumuman', PengumumanController::class)->except(['show']);
});

// Static Pages (takmir_inti & admin)
Route::middleware('role:takmir_inti|admin')->group(function () {
    Route::get('/static-pages', [StaticPageController::class , 'index'])->name('static-pages.index');
    Route::get('/static-pages/{staticPage}/edit', [StaticPageController::class , 'edit'])->name('static-pages.edit');
    Route::put('/static-pages/{staticPage}', [StaticPageController::class , 'update'])->name('static-pages.update');
});

// ─── Content Module (media, takmir_inti & admin) ─────────────────────────────

Route::middleware('role:media|takmir_inti|admin')->group(function () {
    Route::resource('article-categories', ArticleCategoryController::class)->except(['show']);
    Route::resource('articles', ArticleController::class)->except(['show']);
    Route::resource('galleries', GalleryController::class)->except(['show']);
    Route::resource('video-ceramah', VideoCeramahController::class)->except(['show']);
    Route::resource('kutipan-hikmah', KutipanHikmahController::class)->except(['show']);
    Route::resource('kegiatan', KegiatanController::class)->except(['show']);
});

// ─── Pembangunan Module (takmir_inti & admin) ───────────────────────────────
Route::middleware('role:takmir_inti|admin')->group(function () {
    Route::resource('pembangunan', PembangunanController::class)->except(['show']);
    Route::post('/pembangunan/{pembangunan}/upload-photos', [PembangunanController::class , 'uploadPhotos'])->name('pembangunan.upload-photos');
    Route::post('/pembangunan/{pembangunan}/upload-masterplan', [PembangunanController::class , 'uploadMasterplan'])->name('pembangunan.upload-masterplan');
    Route::delete('/pembangunan/{pembangunan}/media/{mediaId}', [PembangunanController::class , 'deleteMedia'])->name('pembangunan.delete-media');
});

// ─── Prayer Times Module (takmir_inti & admin) ──────────────────────────────
Route::middleware('role:takmir_inti|admin')->group(function () {
    Route::get('/prayer-times', [PrayerTimeController::class , 'index'])->name('prayer-times.index');
    Route::post('/prayer-times/sync', [PrayerTimeController::class , 'sync'])->name('prayer-times.sync');
});

// ─── System Module (admin only) ────────────────────────────────────────────────

Route::middleware('role:admin')->group(function () {
    // User Management
    Route::resource('users', UserController::class)->except(['show']);

    // Audit Log
    Route::get('/audit-log', [AuditLogController::class , 'index'])->name('audit-log.index');

    // Contact Messages
    Route::get('/contact-messages', [ContactMessageController::class , 'index'])->name('contact-messages.index');
    Route::get('/contact-messages/{id}', [ContactMessageController::class , 'show'])->name('contact-messages.show');
    Route::patch('/contact-messages/{id}/toggle-read', [ContactMessageController::class , 'toggleRead'])->name('contact-messages.toggle-read');

    // Site Settings
    Route::get('/site-settings', [SiteSettingController::class , 'index'])->name('site-settings.index');
    Route::put('/site-settings', [SiteSettingController::class , 'update'])->name('site-settings.update');

    // Social Links
    Route::post('/social-links/reorder', [App\Http\Controllers\Admin\SocialLinkController::class , 'reorder'])->name('social-links.reorder');
    Route::resource('social-links', App\Http\Controllers\Admin\SocialLinkController::class)->except(['show', 'create', 'edit']); // Using modals/inline

});
