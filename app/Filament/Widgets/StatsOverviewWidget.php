<?php

namespace App\Filament\Widgets;

use App\Enums\TransactionEntiryType;
use App\Enums\TransactionType;
use App\Models\TransactionEntry;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $startOfWeek = $today->copy()->startOfWeek(0);
        $endOfWeek   = $today->copy()->endOfWeek(6);
        $startOfMonth = $today->copy()->startOfMonth();
        $endOfMonth   = $today->copy()->endOfMonth();
        $startOfYear = $today->copy()->startOfYear();
        $endOfYear   = $today->copy()->endOfYear();

        // --- Pengeluaran ---
        // Menjumlahkan entri DEBIT yang terkait dengan akun EXPENSE
        $dailyExpense = $this->sumExpenses($today, $today);
        $weeklyExpense = $this->sumExpenses($startOfWeek, $endOfWeek);
        $monthlyExpense = $this->sumExpenses($startOfMonth, $endOfMonth);
        $yearlyExpense = $this->sumExpenses($startOfYear, $endOfYear);

        // --- Pendapatan ---
        // Menjumlahkan entri CREDIT yang terkait dengan akun REVENUE
        $dailyIncome = $this->sumIncomes($today, $today);
        $weeklyIncome = $this->sumIncomes($startOfWeek, $endOfWeek);
        $monthlyIncome = $this->sumIncomes($startOfMonth, $endOfMonth);
        $yearlyIncome = $this->sumIncomes($startOfYear, $endOfYear);

        return [
            // Pengeluaran
            Stat::make('Pengeluaran Harian', Number::currency($dailyExpense, 'IDR', 'id'))
                ->description('pengeluaran hari ini')
                ->icon('heroicon-o-arrow-trending-down')
                ->color('danger'),
            Stat::make('Pengeluaran Mingguan', Number::currency($weeklyExpense, 'IDR', 'id'))
                ->description('pengeluaran minggu ini')
                ->icon('heroicon-o-arrow-trending-down')
                ->color('danger'),
            Stat::make('Pengeluaran Bulanan', Number::currency($monthlyExpense, 'IDR', 'id'))
                ->description('pengeluaran bulan ini')
                ->icon('heroicon-o-arrow-trending-down')
                ->color('danger'),
            Stat::make('Pengeluaran Tahunan', Number::currency($yearlyExpense, 'IDR', 'id'))
                ->description('pengeluaran tahun ini')
                ->icon('heroicon-o-arrow-trending-down')
                ->color('danger'),

            // Pendapatan
            Stat::make('Pendapatan Harian', Number::currency($dailyIncome, 'IDR', 'id'))
                ->description('pendapatan hari ini')
                ->icon('heroicon-o-arrow-trending-up')
                ->color('success'),
            Stat::make('Pendapatan Mingguan', Number::currency($weeklyIncome, 'IDR', 'id'))
                ->description('pendapatan minggu ini')
                ->icon('heroicon-o-arrow-trending-up')
                ->color('success'),
            Stat::make('Pendapatan Bulanan', Number::currency($monthlyIncome, 'IDR', 'id'))
                ->description('pendapatan bulan ini')
                ->icon('heroicon-o-arrow-trending-up')
                ->color('success'),
            Stat::make('Pendapatan Tahunan', Number::currency($yearlyIncome, 'IDR', 'id'))
                ->description('pendapatan tahun ini')
                ->icon('heroicon-o-arrow-trending-up')
                ->color('success'),
        ];
    }

    /**
     * Hitung total pengeluaran dengan menjumlahkan entri DEBIT pada akun EXPENSE.
     */
    protected function sumExpenses($startDate, $endDate): float
    {
        return TransactionEntry::where('type', TransactionEntiryType::DEBIT)
            ->whereHas('account', function ($q) {
                $q->where('type', \App\Enums\AccountType::EXPENSE);
            })
            ->whereHas('transaction', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('date', [$startDate, $endDate]);
            })
            ->sum('amount');
    }

    /**
     * Hitung total pendapatan dengan menjumlahkan entri CREDIT pada akun REVENUE.
     */
    protected function sumIncomes($startDate, $endDate): float
    {
        return TransactionEntry::where('type', TransactionEntiryType::CREDIT)
            ->whereHas('account', function ($q) {
                $q->where('type', \App\Enums\AccountType::REVENUE);
            })
            ->whereHas('transaction', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('date', [$startDate, $endDate]);
            })
            ->sum('amount');
    }
}
