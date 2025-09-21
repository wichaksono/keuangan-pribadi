<?php

namespace Database\Seeders;

use App\Enums\AccountType;
use App\Enums\TransactionEntiryType;
use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->warn('Seeder Account dilewati karena belum ada user.');
            return;
        }

        $accounts = [
            // ASSET
            ['name' => 'Kas', 'type' => AccountType::ASSET, 'balance' => 10000000],
            ['name' => 'Tabungan Bank', 'type' => AccountType::ASSET, 'balance' => 0],
            ['name' => 'Giro', 'type' => AccountType::ASSET, 'balance' => 0],
            ['name' => 'E-wallet', 'type' => AccountType::ASSET, 'balance' => 0],
            ['name' => 'Deposito', 'type' => AccountType::ASSET, 'balance' => 0],
            ['name' => 'Rumah', 'type' => AccountType::ASSET, 'balance' => 0],
            ['name' => 'Mobil', 'type' => AccountType::ASSET, 'balance' => 0],
            ['name' => 'Motor', 'type' => AccountType::ASSET, 'balance' => 0],
            ['name' => 'Perabot Rumah Tangga', 'type' => AccountType::ASSET, 'balance' => 0],
            ['name' => 'Peralatan Elektronik', 'type' => AccountType::ASSET, 'balance' => 0],

            // LIABILITY
            ['name' => 'Utang Kartu Kredit', 'type' => AccountType::LIABILITY, 'balance' => 1000000],
            ['name' => 'Pinjaman Bank', 'type' => AccountType::LIABILITY, 'balance' => 0],
            ['name' => 'Cicilan Mobil', 'type' => AccountType::LIABILITY, 'balance' => 0],
            ['name' => 'Cicilan Motor', 'type' => AccountType::LIABILITY, 'balance' => 0],
            ['name' => 'Cicilan Rumah', 'type' => AccountType::LIABILITY, 'balance' => 0],
            ['name' => 'Utang Teman / Keluarga', 'type' => AccountType::LIABILITY, 'balance' => 0],
            ['name' => 'Tagihan Listrik', 'type' => AccountType::LIABILITY, 'balance' => 0],
            ['name' => 'Tagihan Air', 'type' => AccountType::LIABILITY, 'balance' => 0],
            ['name' => 'Tagihan Internet / Telepon', 'type' => AccountType::LIABILITY, 'balance' => 0],
            ['name' => 'Hutang Belanja Online', 'type' => AccountType::LIABILITY, 'balance' => 0],

            // EQUITY
            ['name' => 'Modal Awal Keluarga', 'type' => AccountType::EQUITY, 'balance' => 0],
            ['name' => 'Tabungan Darurat', 'type' => AccountType::EQUITY, 'balance' => 0],
            ['name' => 'Tabungan Pendidikan Anak', 'type' => AccountType::EQUITY, 'balance' => 0],
            ['name' => 'Investasi Pribadi', 'type' => AccountType::EQUITY, 'balance' => 0],
            ['name' => 'Dana Liburan', 'type' => AccountType::EQUITY, 'balance' => 0],
            ['name' => 'Dana Pensiun', 'type' => AccountType::EQUITY, 'balance' => 0],
            ['name' => 'Modal Usaha Kecil', 'type' => AccountType::EQUITY, 'balance' => 0],
            ['name' => 'Laba Ditahan', 'type' => AccountType::EQUITY, 'balance' => 0],
            ['name' => 'Setoran Owner / Family Fund', 'type' => AccountType::EQUITY, 'balance' => 0],
            ['name' => 'Distribusi Laba Keluarga', 'type' => AccountType::EQUITY, 'balance' => 0],

            // REVENUE
            ['name' => 'Gaji Bulanan', 'type' => AccountType::REVENUE, 'balance' => 0],
            ['name' => 'Tunjangan Transportasi', 'type' => AccountType::REVENUE, 'balance' => 0],
            ['name' => 'Tunjangan Makan', 'type' => AccountType::REVENUE, 'balance' => 0],
            ['name' => 'Bonus / Insentif', 'type' => AccountType::REVENUE, 'balance' => 0],
            ['name' => 'Pendapatan Freelance', 'type' => AccountType::REVENUE, 'balance' => 0],
            ['name' => 'Pendapatan Sewa Properti', 'type' => AccountType::REVENUE, 'balance' => 0],
            ['name' => 'Bunga Bank / Deposito', 'type' => AccountType::REVENUE, 'balance' => 0],
            ['name' => 'Dividen Saham', 'type' => AccountType::REVENUE, 'balance' => 0],
            ['name' => 'Hadiah / Lotere', 'type' => AccountType::REVENUE, 'balance' => 0],
            ['name' => 'Penjualan Barang Bekas', 'type' => AccountType::REVENUE, 'balance' => 0],

            // EXPENSE
            ['name' => 'Makanan & Minuman', 'type' => AccountType::EXPENSE, 'balance' => 0],
            ['name' => 'Listrik', 'type' => AccountType::EXPENSE, 'balance' => 0],
            ['name' => 'Air', 'type' => AccountType::EXPENSE, 'balance' => 0],
            ['name' => 'Internet & Telepon', 'type' => AccountType::EXPENSE, 'balance' => 0],
            ['name' => 'Transportasi', 'type' => AccountType::EXPENSE, 'balance' => 0],
            ['name' => 'Pendidikan Anak', 'type' => AccountType::EXPENSE, 'balance' => 0],
            ['name' => 'Kesehatan / Obat-obatan', 'type' => AccountType::EXPENSE, 'balance' => 0],
            ['name' => 'Hiburan / Rekreasi', 'type' => AccountType::EXPENSE, 'balance' => 0],
            ['name' => 'Pakaian & Sepatu', 'type' => AccountType::EXPENSE, 'balance' => 0],
            ['name' => 'Peralatan Rumah Tangga', 'type' => AccountType::EXPENSE, 'balance' => 0],
        ];

        foreach ($accounts as $data) {
            $data['is_active']  = true;
            $data['created_by'] = $user->id;

            // Set normal_position berdasarkan tipe akun
            switch ($data['type']) {
                case AccountType::ASSET:
                case AccountType::EXPENSE:
                    $data['normal_position'] = TransactionEntiryType::DEBIT;
                    break;
                case AccountType::LIABILITY:
                case AccountType::EQUITY:
                case AccountType::REVENUE:
                    $data['normal_position'] = TransactionEntiryType::CREDIT;
                    break;
            }

            Account::create($data);
        }
    }
}
