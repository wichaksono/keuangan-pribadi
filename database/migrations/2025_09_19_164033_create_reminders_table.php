<?php

use App\Enums\ReminderPriority;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description')->nullable();

            $table->string('reference_type')->nullable();
            $table->string('reference_id', 36)->nullable();

            $table->string('priority', 10)
                ->default(ReminderPriority::NORMAL)
                ->index();

            $table->dateTime('reminder_at')->nullable();
            $table->dateTime('completed_at')->nullable();

            $table->boolean('is_completed')->default(false);
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');

            $table->timestamps();

            $table->index(['reference_type', 'reference_id']);
            $table->index(['reminder_at', 'is_completed']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
