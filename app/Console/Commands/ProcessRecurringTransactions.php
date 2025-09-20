<?php

namespace App\Console\Commands;

use App\Models\RecurringTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Throwable;

/**
 * Class ProcessRecurringTransactions
 *
 * This command processes active recurring transactions
 * and generates new transactions when the reminder (next_date)
 * is due. The next reminder date will be set 30 days before
 * the actual due date of the next cycle.
 *
 * Usage: php artisan recurring:process
 */
class ProcessRecurringTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurring:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate transactions from recurring rules if reminder (next_date) has been reached.';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Throwable
     */
    public function handle(): int
    {
        $today = Carbon::today();

        $recurrings = RecurringTransaction::where('is_active', true)
            ->whereDate('next_date', '<=', $today)
            ->get();

        foreach ($recurrings as $recurring) {
            DB::transaction(function () use ($recurring, $today) {
                // Create a new transaction record
                Transaction::create([
                    'title'       => $recurring->name,
                    'description' => $recurring->description,
                    'amount'      => $recurring->amount,
                    'type'        => 'expense', // adjust if you have enum for income/expense
                    'date'        => $today,
                    'category_id' => $recurring->category_id,
                ]);

                // Calculate next reminder date (30 days before due date)
                $recurring->next_date = $this->calculateNextReminderDate($recurring, $today);
                $recurring->save();
            });
        }

        $this->info("Processed {$recurrings->count()} recurring transactions.");

        return SymfonyCommand::SUCCESS;
    }

    /**
     * Calculate the next reminder date (30 days before due date).
     *
     * @param  RecurringTransaction  $recurring
     * @param  Carbon  $current
     * @return Carbon|null
     */
    protected function calculateNextReminderDate(RecurringTransaction $recurring, Carbon $current): ?Carbon
    {
        $dueDate = match ($recurring->frequency) {
            'daily'   => $current->copy()->addDay(),
            'weekly'  => $current->copy()->addWeek(),
            'monthly' => $current->copy()->addMonth(),
            'yearly'  => $current->copy()->addYear(),
            'custom'  => $this->calculateCustomDueDate($recurring, $current),
            default   => null,
        };

        return $dueDate?->copy()->subDays(30);
    }

    /**
     * Calculate due date for custom recurring frequency.
     *
     * @param  RecurringTransaction  $recurring
     * @param  Carbon  $current
     * @return Carbon|null
     */
    protected function calculateCustomDueDate(RecurringTransaction $recurring, Carbon $current): ?Carbon
    {
        $interval = $recurring->custom_frequency['interval'] ?? null;
        $unit     = $recurring->custom_frequency['unit'] ?? null;

        if ($interval && $unit) {
            return $current->copy()->add($unit, $interval);
        }

        return null;
    }
}
