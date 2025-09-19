<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReminderAssign extends Model
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
