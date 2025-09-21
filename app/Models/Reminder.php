<?php

namespace App\Models;

use App\Enums\ReminderPriority;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Reminder extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'description',
        'reference_type',
        'reference_id',
        'priority',
        'reminder_at',
        'completed_at',
        'is_completed',
        'created_by',
    ];

    protected $casts = [
        'priority'     => ReminderPriority::class,
        'reminder_at'  => 'datetime',
        'completed_at' => 'datetime',
        'is_completed' => 'boolean',
    ];

    // Relasi ke user yang membuat
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Polymorphic relation ke reference (jika ada)
    public function reference(): MorphTo
    {
        return $this->morphTo();
    }

    // Relasi ke assignments
    public function assigns(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'reminder_assigns', 'reminder_id', 'user_id')
            ->using(ReminderAssign::class);
    }

    /**
     * --------------------------------------------------
     * SCOPES
     * --------------------------------------------------
     */
    // Scope untuk filter yang belum selesai
    public function scopePending($query)
    {
        return $query->where('is_completed', false);
    }

    // Scope untuk filter berdasarkan prioritas
    public function scopePriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }
}
