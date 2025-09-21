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
        Schema::create('recurring_expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignUuid('account_id')
                ->nullable()
                ->constrained('accounts')
                ->nullOnDelete();
            $table->decimal('amount', 15, 2);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('frequency');
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_expenses');
    }
};
