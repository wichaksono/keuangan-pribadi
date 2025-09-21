<?php

namespace App\Models;

use App\Enums\AccountType;
use App\Enums\TransactionEntiryType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasUuids;

    protected $fillable = [
        'code',
        'name',
        'type',
        'balance',
        'is_active',
        'created_by',
        'normal_position',
    ];

    protected $casts = [
        'type'            => AccountType::class,
        'balance'         => 'float',
        'is_active'       => 'boolean',
        'normal_position' => TransactionEntiryType::class,
    ];

    protected static function booted(): void
    {
        static::creating(function ($account) {
            if (empty($account->code)) {
                $account->code = static::generateCode($account->type);
            }
        });
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * --------------------------------------------------
     * Scopes
     * --------------------------------------------------
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeType($query, AccountType $type)
    {
        return $query->where('type', $type);
    }

    /**
     * --------------------------------------------------
     * Helpers
     * --------------------------------------------------
     */
    public static function generateCode(AccountType $type): string
    {
        // Prefix berdasarkan tipe akun
        $prefix = match ($type) {
            AccountType::ASSET     => '1',
            AccountType::LIABILITY => '2',
            AccountType::EQUITY    => '3',
            AccountType::REVENUE   => '4',
            AccountType::EXPENSE   => '5',
        };

        // Ambil kode terakhir berdasarkan prefix
        $lastCode = static::where('type', $type)
            ->where('code', 'like', $prefix.'%')
            ->orderBy('code', 'desc')
            ->value('code');

        // Nomor urut berikutnya
        $next = $lastCode ? ((int)substr($lastCode, 1)) + 1 : 1;

        return $prefix.str_pad($next, 3, '0', STR_PAD_LEFT);
    }

    public static function isNormalDebit(AccountType $type): bool
    {
        return in_array($type, [AccountType::ASSET, AccountType::EXPENSE]);
    }

    public static function isNormalCredit(AccountType $type): bool
    {
        return in_array($type, [AccountType::LIABILITY, AccountType::EQUITY, AccountType::REVENUE]);
    }
}
