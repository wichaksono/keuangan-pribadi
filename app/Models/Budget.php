<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Budget extends Model
{
    use HasUuids;

    protected $fillable = [
        'category_id',
        'amount',
        'month',
        'year',
        'notes',
        'created_by',
    ];

    // Relasi ke Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relasi ke User (creator)
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Accessor untuk nama bulan (opsional)
    public function getMonthNameAttribute(): string
    {
        return Carbon::create()->month($this->month)->translatedFormat('F');
    }
}
