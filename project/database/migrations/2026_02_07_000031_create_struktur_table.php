<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('struktur', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('foto')->nullable();
            $table->string('kontak')->nullable();
            $table->integer('order_column')->default(0);
            $table->timestamps();

            $table->index('order_column');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('struktur');
    }
};
