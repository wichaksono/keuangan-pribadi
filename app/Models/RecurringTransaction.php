<?php

namespace App\Models;

use App\Enums\Frequency;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class RecurringTransaction extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
        'amount',
        'frequency',
        'custom_frequency',
        'category_id',
        'start_date',
        'end_date',
        'next_date',
        'is_active',
    ];

    protected $casts = [
        'frequency'        => Frequency::class,
        'amount'           => 'float',
        'start_date'       => 'date',
        'end_date'         => 'date',
        'next_date'        => 'date',
        'is_active'        => 'boolean',
        'custom_frequency' => 'array',
    ];

    protected static function booted(): void
    {
        static::saving(function ($model) {
            // Jika is_active = false, set end_date otomatis kalau belum ada
            if ($model->is_active === false && $model->end_date === null) {
                $model->end_date = Carbon::today();
            }

            // Jika is_active = true, end_date harus null
            if ($model->is_active) {
                $model->end_date = null;
            }
        });
    }

    // Relasi ke Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
