<?php

namespace App\Models;

use App\Enums\AccountType;
use App\Enums\Frequency;
use App\Enums\ReminderPriority;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

class RecurringExpense extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
        'account_id',
        'amount',
        'due_date',
        'is_completed',
        'is_active',
        'frequency',
        'custom_frequency',
        'next_date',
        'end_date',
        'reminder_at',
        'created_by',
    ];

    protected $casts = [
        'reminder_at'      => 'integer', // days before due date to remind
        'due_date'         => 'date',
        'end_date'         => 'date',
        'next_date'        => 'date',
        'amount'           => 'float',
        'is_active'        => 'boolean',
        'frequency'        => Frequency::class,
        'custom_frequency' => 'array',
    ];

    /**
     * Booted method for model events.
     */
    protected static function booted(): void
    {
        static::saving(function (RecurringExpense $expense) {
            // Jika next_date belum diisi atau sudah lewat
            if (!$expense->next_date || $expense->next_date < now()->toDateString()) {
                $expense->next_date = self::calculateNextDate($expense);
            }

            // Simpan atau perbarui reminder terkait
            self::saveReminder($expense);
        });
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }


    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function reminder(): MorphOne
    {
        return $this->morphOne(Reminder::class, 'reference');
    }

    /**
     * ------------------------------------------------
     * Helpers
     * ------------------------------------------------
     */
    public static function getAccountsWithGroups(): array
    {
        $accounts = Account::whereIn('type', [AccountType::EXPENSE, AccountType::LIABILITY])
            ->orderBy('name', 'asc')
            ->orderBy('code', 'desc')
            ->get();

        $grouped = [];
        foreach ($accounts as $account) {
            $grouped[$account->type->getLabel()][$account->id] = $account->name;
        }

        return $grouped;
    }

    /**
     * Calculate the next occurrence date based on frequency and custom frequency.
     */
    protected static function calculateNextDate(RecurringExpense $expense)
    {
        $from = $expense->next_date ? Carbon::parse($expense->next_date)
            : ($expense->due_date ? Carbon::parse($expense->due_date) : now());

        return match ($expense->frequency) {
            Frequency::DAILY   => $from->addDay(),
            Frequency::WEEKLY  => $from->addWeek(),
            Frequency::MONTHLY => $from->addMonth(),
            Frequency::YEARLY  => $from->addYear(),
            Frequency::CUSTOM  => self::calculateCustomFrequency($expense, $from),
            default            => $from,
        };
    }

    /**
     * Calculate next date for custom frequency.
     * Ex: {"unit": "weeks", "value": 2} means every 2 weeks
     */
    protected static function calculateCustomFrequency(RecurringExpense $expense, Carbon $from): Carbon
    {
        if (!$expense->custom_frequency || !is_array($expense->custom_frequency)) {
            return $from;
        }

        $unit  = $expense->custom_frequency['unit'] ?? 'days'; // days, weeks, months, years
        $value = $expense->custom_frequency['value'] ?? 0;

        return match ($unit) {
            'days'   => $from->addDays($value),
            'weeks'  => $from->addWeeks($value),
            'months' => $from->addMonths($value),
            'years'  => $from->addYears($value),
            default  => $from,
        };
    }

    /**
     * Save or update the reminder associated with the recurring expense.
     */
    protected static function saveReminder(RecurringExpense $expense): void
    {
        if ($expense->reminder_at === null) {
            if ($expense->reminder) {
                $expense->reminder->delete();
            }
            return;
        }

        $reminderDate = Carbon::parse($expense->next_date)
            ->subDays($expense->reminder_at)
            ->startOfDay();

        $reminderData = [
            'title'        => $expense->name,
            'description'  => $expense->description,
            'priority'     => ReminderPriority::NORMAL,
            'reminder_at'  => $reminderDate,
            'is_completed' => false, // Pengingat baru belum selesai
            'created_by'   => $expense->created_by,
        ];

        $expense->reminder()->updateOrCreate([
            'reference_id'   => $expense->id,
            'reference_type' => RecurringExpense::class
        ],
            $reminderData
        );
    }
}


