<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->enum('jenis', ['kajian', 'maulid', 'sosial', 'remaja']);
            $table->date('tanggal');
            $table->time('waktu')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('ustadz')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('banner_image')->nullable();
            $table->enum('status', ['upcoming', 'ongoing', 'completed', 'cancelled'])->default('upcoming');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->index('tanggal', 'idx_kegiatan_tanggal');
            $table->index('status', 'idx_kegiatan_status');
            $table->index('jenis', 'idx_kegiatan_jenis');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
