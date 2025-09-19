<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;

class StatsOverviewWidget extends BaseWidget
{
    /**
     * @return array<Stat>
     */
    protected function getStats(): array
    {
        // Mendapatkan tanggal hari ini
        $today = Carbon::today();

        // Mendapatkan tanggal awal dan akhir minggu ini.
        // Menggunakan integer (0 untuk Minggu, 6 untuk Sabtu) untuk menghindari error konstanta.
        $startOfWeek = $today->copy()->startOfWeek(0);
        $endOfWeek = $today->copy()->endOfWeek(6);

        // Mendapatkan tanggal awal dan akhir bulan ini
        $startOfMonth = $today->copy()->startOfMonth();
        $endOfMonth = $today->copy()->endOfMonth();

        // Mendapatkan tanggal awal dan akhir tahun ini
        $startOfYear = $today->copy()->startOfYear();
        $endOfYear = $today->copy()->endOfYear();

        $dailyExpense = Transaction::where('type', 'expense')
            ->whereDate('date', $today)
            ->sum('amount');

        $weeklyExpense = Transaction::where('type', 'expense')
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->sum('amount');

        // --- Perhitungan Bulanan ---
        $monthlyIncome = Transaction::where('type', 'income')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $monthlyExpense = Transaction::where('type', 'expense')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        // --- Perhitungan Tahunan ---
        $yearlyIncome = Transaction::where('type', 'income')
            ->whereBetween('date', [$startOfYear, $endOfYear])
            ->sum('amount');

        $yearlyExpense = Transaction::where('type', 'expense')
            ->whereBetween('date', [$startOfYear, $endOfYear])
            ->sum('amount');

        return [
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

            // Stat untuk Bulanan
            Stat::make('Pendapatan Bulanan', Number::currency($monthlyIncome, 'IDR', 'id'))
                ->description('pendapatan bulan ini')
                ->icon('heroicon-o-arrow-trending-up')
                ->color('success'),

            // Stat untuk Tahunan
            Stat::make('Pendapatan Tahunan', Number::currency($yearlyIncome, 'IDR', 'id'))
                ->description('pendapatan tahun ini')
                ->icon('heroicon-o-arrow-trending-up')
                ->color('success'),
        ];
    }
}
