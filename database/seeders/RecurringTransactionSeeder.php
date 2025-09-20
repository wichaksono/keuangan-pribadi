<?php

namespace Database\Seeders;

use App\Enums\TransactionType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RecurringTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $categories = DB::table('categories')
            ->where('type', TransactionType::EXPENSE)
            ->pluck('id')
            ->toArray();

        $transactions = [];

        for ($i = 1; $i <= 10; $i++) {
            $transactions[] = [
                'id'               => Str::uuid(),
                'name'             => 'Transaction '.$i,
                'description'      => 'Description '.$i,
                'amount'           => rand(1000, 1000000),
                'frequency'        => ['daily', 'weekly', 'monthly', 'yearly'][array_rand([
                    'daily',
                    'weekly',
                    'monthly',
                    'yearly'
                ])],
                'custom_frequency' => null,
                'category_id'      => $categories[array_rand($categories)],
                'start_date'       => Carbon::today()->subDays(rand(0, 30)),
                'end_date'         => null,
                'next_date'        => Carbon::today()->addDays(rand(1, 30)),
                'is_active'        => true,
                'created_at'       => now(),
                'updated_at'       => now(),
            ];
        }

        DB::table('recurring_transactions')->insert($transactions);
    }
}
