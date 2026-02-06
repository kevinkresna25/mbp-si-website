<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('donation_targets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category_ziswaf', ['zakat', 'infaq', 'sedekah', 'wakaf', 'operasional']);
            $table->decimal('target_amount', 15, 2);
            $table->decimal('current_amount', 15, 2)->default(0);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['active', 'completed', 'paused'])->default('active');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->index('status', 'idx_dt_status');
            $table->index('category_ziswaf', 'idx_dt_category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_targets');
    }
};
