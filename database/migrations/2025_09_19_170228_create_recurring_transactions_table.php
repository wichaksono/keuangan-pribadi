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
        Schema::create('recurring_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('amount', 20, 2);
            $table->string('frequency', 20); // e.g., daily, weekly, monthly, yearly, custom
            $table->json('custom_frequency')->nullable(); // e.g., {"interval": 10, "unit": "days"}
            $table->foreignUuid('category_id')->constrained('categories')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('next_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('name');
            $table->index('next_date');
            $table->index('is_active');
            $table->index('frequency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_transactions');
    }
};
