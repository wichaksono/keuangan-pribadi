<?php

namespace App\Filament\Resources\RecurringTransactions\Schemas;

use App\Filament\Utils\Currency;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RecurringTransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Transaksi')
                    ->description('Detail umum tentang transaksi berulang.')
                    ->columns()
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Transaksi'),
                        TextEntry::make('category.name')
                            ->label('Kategori')
                            ->badge(),
                        TextEntry::make('amount')
                            ->label('Jumlah')
                            ->numeric()
                            ->prefix(Currency::symbol()),
                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->placeholder('-')
                            ->columnSpanFull(),

                    ]),
                Section::make('Jadwal Transaksi')
                    ->description('Pengaturan frekuensi dan tanggal transaksi.')
                    ->columns()
                    ->schema([
                        TextEntry::make('frequency')
                            ->badge()
                            ->label('Frekuensi'),
                        IconEntry::make('is_active')
                            ->label('Status')
                            ->boolean(),
                        TextEntry::make('start_date')
                            ->label('Tanggal Mulai')
                            ->date()
                            ->icon('heroicon-o-calendar'),
                        TextEntry::make('end_date')
                            ->label('Tanggal Selesai')
                            ->date()
                            ->placeholder('-')
                            ->icon('heroicon-o-calendar'),
                        TextEntry::make('custom_frequency')
                            ->label('Frekuensi Kustom')
                            ->placeholder('-')
                            ->columnSpanFull(),

                    ]),
                Section::make('Riwayat')
                    ->description('Informasi tanggal pembuatan dan pembaruan.')
                    ->columns()
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->label('Diperbarui Pada')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
