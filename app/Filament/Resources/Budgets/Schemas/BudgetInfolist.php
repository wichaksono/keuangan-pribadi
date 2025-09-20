<?php

namespace App\Filament\Resources\Budgets\Schemas;

use App\Filament\Utils\Currency;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class BudgetInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Anggaran')
                    ->description('Detail anggaran yang dibuat.')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('category.name')
                            ->label('Kategori')
                            ->badge(),
                        TextEntry::make('month_name')
                            ->label('Bulan')
                            ->icon(Heroicon::OutlinedCalendarDateRange),
                        TextEntry::make('year')
                            ->label('Tahun')
                            ->icon(Heroicon::OutlinedCalendar),
                        TextEntry::make('amount')
                            ->label('Jumlah')
                            ->numeric()
                            ->prefix(Currency::symbol())
                            ->icon(Heroicon::OutlinedCurrencyDollar)
                            ->columnSpanFull(),
                        TextEntry::make('notes')
                            ->label('Catatan')
                            ->placeholder('-')
                            ->columnSpanFull(),

                    ]),
                Section::make('Detail Tambahan')
                    ->description('Catatan dan informasi riwayat.')
                    ->columns()
                    ->schema([
                        TextEntry::make('creator.name')
                            ->label('Dibuat oleh')
                            ->numeric()
                            ->columnSpanFull(),
                        TextEntry::make('created_at')
                            ->label('Tanggal Dibuat')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->label('Tanggal Diperbarui')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
