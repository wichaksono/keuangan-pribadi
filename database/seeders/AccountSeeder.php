<?php

namespace Database\Seeders;

use App\Enums\AccountType;
use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (! $user) {
            $this->command->warn('Seeder Account dilewati karena belum ada user.');
            return;
        }

        $accounts = [
            [
                'name'       => 'Dompet Tunai',
                'type'       => AccountType::CASH,
                'balance'    => 500000,
                'currency'   => 'IDR',
                'is_active'  => true,
                'created_by' => $user->id,
            ],
            [
                'name'       => 'Rekening BCA',
                'type'       => AccountType::BANK,
                'balance'    => 2500000,
                'currency'   => 'IDR',
                'is_active'  => true,
                'created_by' => $user->id,
            ],
            [
                'name'       => 'OVO',
                'type'       => AccountType::EWALLET,
                'balance'    => 150000,
                'currency'   => 'IDR',
                'is_active'  => true,
                'created_by' => $user->id,
            ],
            [
                'name'       => 'Tabungan Pendidikan',
                'type'       => AccountType::SAVING,
                'balance'    => 10000000,
                'currency'   => 'IDR',
                'is_active'  => true,
                'created_by' => $user->id,
            ],
        ];

        foreach ($accounts as $data) {
            Account::create($data);
        }
    }
}
