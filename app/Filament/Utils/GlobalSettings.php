<?php

namespace App\Filament\Utils;

final class GlobalSettings
{
    public static function getMonths(): array
    {
        return [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
    }

    public static function getYears(): array
    {
        $range       = config('keuangan.year_range', 80);
        $years       = [];
        $currentYear = (int)date('Y'); // pastikan integer

        for ($i = $currentYear - $range; $i <= $currentYear + $range; $i++) {
            $years[$i] = (string)$i;
        }

        return $years;
    }
}
