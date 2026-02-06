<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->date('tanggal');
            $table->enum('type', ['debit', 'credit']);
            $table->enum('category_ziswaf', ['zakat', 'infaq', 'sedekah', 'wakaf', 'operasional']);
            $table->string('category_detail');
            $table->decimal('nominal', 15, 2);
            $table->text('keterangan')->nullable();
            $table->string('bukti_foto')->nullable();
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected'])->default('draft');
            $table->text('rejection_reason')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->index('tanggal', 'idx_tanggal');
            $table->index('status', 'idx_status');
            $table->index('category_ziswaf', 'idx_category_ziswaf');
            $table->index('created_by', 'idx_created_by');
            $table->index('approved_at', 'idx_approved_at');
            $table->index(['tanggal', 'status', 'category_ziswaf'], 'idx_composite');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
