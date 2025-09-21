<?php

namespace Database\Seeders;

use App\Enums\AccountType;
use App\Models\Account;
use App\Models\Budget;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user pertama sebagai creator
        $user = User::first();

        if (! $user) {
            $this->command->warn('Seeder Budget dilewati karena belum ada user.');
            return;
        }

        // Ambil beberapa kategori pengeluaran
        $accounts = Account::where('type', AccountType::ASSET)
            ->get();

        if ($accounts->isEmpty()) {
            $this->command->warn('Seeder Budget dilewati karena belum ada kategori expense.');
            return;
        }

        $year = now()->year;

        foreach (range(1, 12) as $month) {
            foreach ($accounts as $account) {
                Budget::create([
                    'account_id' => $account->id,
                    'amount'      => fake()->randomFloat(2, 500000, 3000000), // 500 ribu – 3 juta
                    'month'       => $month,
                    'year'        => $year,
                    'notes'       => 'Budget bulanan untuk ' . $account->name,
                    'created_by'  => $user->id,
                ]);
            }
        }
    }
}
