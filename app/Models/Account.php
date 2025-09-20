<?php

namespace App\Models;

use App\Enums\AccountType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'type',
        'balance',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'type'      => AccountType::class,
        'balance'   => 'float',
        'is_active' => 'boolean',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
