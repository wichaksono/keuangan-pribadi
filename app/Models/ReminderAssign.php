<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ReminderAssign extends Pivot
{
    use HasUuids;

    protected $fillable = [
        'reminder_id',
        'user_id',
    ];

    public function reminder(): BelongsTo
    {
        return $this->belongsTo(Reminder::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
