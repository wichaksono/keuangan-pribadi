<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');                  // Nama akun, contoh: BCA, Dompet, OVO
            $table->string('type', 30)->index();     // Jenis akun: cash, bank, ewallet, saving
            $table->decimal('balance', 20, 2)->default(0); // Saldo saat ini
            $table->boolean('is_active')->default(true);    // Bisa dipakai atau tidak
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->index(['type', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
