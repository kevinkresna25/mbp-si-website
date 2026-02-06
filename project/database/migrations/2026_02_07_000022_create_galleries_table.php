<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('category', ['kegiatan', 'pembangunan', 'umum'])->default('umum');
            $table->date('tanggal');
            $table->foreignId('uploaded_by')->constrained('users');
            $table->timestamps();
            $table->index('category', 'idx_gallery_category');
            $table->index('tanggal', 'idx_gallery_tanggal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
