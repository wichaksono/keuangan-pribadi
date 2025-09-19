<?php

namespace Database\Seeders;

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
        $categories = Category::where('type', 'expense')
            ->whereIn('name', ['Makanan & Minuman', 'Transportasi', 'Tagihan'])
            ->get();

        if ($categories->isEmpty()) {
            $this->command->warn('Seeder Budget dilewati karena belum ada kategori expense.');
            return;
        }

        $year = now()->year;

        foreach (range(1, 12) as $month) {
            foreach ($categories as $category) {
                Budget::create([
                    'category_id' => $category->id,
                    'amount'      => fake()->randomFloat(2, 500000, 3000000), // 500 ribu – 3 juta
                    'month'       => $month,
                    'year'        => $year,
                    'notes'       => 'Budget bulanan untuk ' . $category->name,
                    'created_by'  => $user->id,
                ]);
            }
        }
    }
}
