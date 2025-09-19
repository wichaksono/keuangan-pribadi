<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Reminder extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'description',
        'reference_type',
        'reference_id',
        'reminder_at',
        'is_completed',
        'created_by',
    ];

    protected $casts = [
        'reminder_at'  => 'date',
        'is_completed' => 'boolean',
    ];

    // Relasi ke user pembuat
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Polymorphic manual: reference ke model lain
    public function reference(): MorphTo
    {
        return $this->morphTo();
    }

    // Scope: hanya yang belum selesai
    public function scopePending($query)
    {
        return $query->where('is_completed', false)
            ->whereDate('reminder_at', '<=', Carbon::today());
    }

    // Scope: yang sudah selesai
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }
}
