<?php

namespace App\Models;

use App\Enums\TransactionEntiryType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionEntry extends Model
{
    use HasUuids;

    protected $fillable = [
        'transaction_id',
        'account_id',
        'type',
        'balance_before',
        'amount',
        'balance_after',
    ];

    protected $casts = [
        'type'           => TransactionEntiryType::class,
        'amount'         => 'float',
        'balance_before' => 'float',
        'balance_after'  => 'float',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (TransactionEntry $entry) {
            $account = $entry->account;
            if (!$account) {
                return;
            }

            // Ambil saldo sebelum
            $entry->balance_before = $account->balance ?? 0;

            // Dapatkan normal_position dari akun yang terkait
            $normal_position = $account->normal_position;

            // Jika type entri (debit/kredit) sama dengan normal_position akun, maka saldo bertambah
            $is_increase = $entry->type === $normal_position;

            // Hitung saldo sesudah
            if ($is_increase) {
                $entry->balance_after = $entry->balance_before + $entry->amount;
            } else {
                $entry->balance_after = $entry->balance_before - $entry->amount;
            }

            // Update saldo akun
            $account->balance = $entry->balance_after;
            $account->save();
        });
    }


    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class)
            ->orderBy('code');
    }
}
