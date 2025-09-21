<?php

namespace App\Models;

use App\Enums\TransactionEntiryType;
use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'description',
        'type',
        'date',
        'attachments',
        'created_by',
    ];

    protected $casts = [
        'type'        => TransactionType::class,
        'date'        => 'date',
        'attachments' => 'array',
    ];

    public function entries(): HasMany
    {
        return $this->hasMany(TransactionEntry::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * --------------------------------------------------
     * accessors
     * --------------------------------------------------
     */
    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->entries->where('type', TransactionEntiryType::DEBIT)->sum('amount'),
        );
    }

    protected function totalDebit(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->entries->where('type', TransactionEntiryType::DEBIT)->sum('amount'),
        );
    }

    protected function totalCredit(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->entries->where('type', TransactionEntiryType::CREDIT)->sum('amount'),
        );
    }
}
