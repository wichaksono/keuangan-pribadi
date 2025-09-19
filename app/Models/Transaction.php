<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'description',
        'amount',
        'type',
        'date',
        'category_id',
        'account_id',
        'attachments',
        'created_by',
    ];

    protected $casts = [
        'type'        => TransactionType::class,
        'date'        => 'date',
        'attachments' => 'array',
        'amount'      => 'float',
    ];

    // Relasi ke Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relasi ke Account
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    // Relasi ke User (creator)
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
