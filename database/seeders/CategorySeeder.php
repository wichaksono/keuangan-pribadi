<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Kategori utama pemasukan
        $incomeCategories = [
            'Gaji',
            'Bonus',
            'Investasi',
            'Lainnya',
        ];

        foreach ($incomeCategories as $name) {
            Category::create([
                'name'        => $name,
                'description' => null,
                'type'        => 'income', // TransactionType::INCOME kalau pakai enum
                'parent_id'   => null,
            ]);
        }

        // Kategori utama pengeluaran
        $expenseCategories = [
            'Makanan & Minuman',
            'Transportasi',
            'Kesehatan',
            'Pendidikan',
            'Tagihan',
            'Hiburan',
            'Belanja',
            'Lainnya',
        ];

        foreach ($expenseCategories as $name) {
            Category::create([
                'name'        => $name,
                'description' => null,
                'type'        => 'expense', // TransactionType::EXPENSE kalau pakai enum
                'parent_id'   => null,
            ]);
        }
    }
}
