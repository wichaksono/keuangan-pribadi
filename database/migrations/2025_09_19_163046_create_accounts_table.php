<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();       // Kode akun, contoh: BCA-001, OVO-01
            $table->string('name');                  // Nama akun, contoh: BCA, Dompet, OVO
            $table->string('type', 30)->index();     // Jenis akun: cash, bank, ewallet, saving
            $table->decimal('balance', 20, 2)->default(0); // Saldo saat ini
            $table->boolean('is_active')->default(true);    // Bisa dipakai atau tidak
            $table->string('normal_position', 10)->index();   // Posisi normal: debit, credit
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
