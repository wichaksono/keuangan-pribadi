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
        Schema::create('transaction_entries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('transaction_id')->constrained('transactions')->onDelete('cascade');
            $table->foreignUuid('account_id')->constrained('accounts')->onDelete('cascade');
            $table->string('type', 20)->index(); // debit or credit
            $table->decimal('balance_before', 20, 2);
            $table->decimal('amount', 20, 2);
            $table->decimal('balance_after', 20, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_entiries');
    }
};
