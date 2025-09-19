<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
        'type',
        'parent_id',
        'order_column',
        'depth',
    ];

    protected $casts = [
        'type' => TransactionType::class,
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('ordered', function (Builder $builder) {
            $builder
                ->select('categories.*')
                ->selectRaw('COALESCE(parent_id, id) * 1000 + order_column AS full_order')
                ->orderBy('full_order');
        });

        static::creating(function ($category) {
            // Hitung depth
            $category->depth = $category->parent_id
                ? (Category::find($category->parent_id)?->depth ?? 0) + 1
                : 0;

            // Hitung order_column otomatis per parent_id
            $maxOrder               = Category::where('parent_id', $category->parent_id)->max('order_column');
            $category->order_column = $maxOrder ? $maxOrder + 1 : 1;
        });

        static::updating(function ($category) {
            // Update depth jika parent berubah
            $category->depth = $category->parent_id
                ? (Category::find($category->parent_id)?->depth ?? 0) + 1
                : 0;

            // Jika parent_id berubah, reset order_column
            if ($category->isDirty('parent_id')) {
                $maxOrder               = Category::where('parent_id', $category->parent_id)->max('order_column');
                $category->order_column = $maxOrder ? $maxOrder + 1 : 1;
            }
        });
    }

    // Relasi parent
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Relasi children
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
