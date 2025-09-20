<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Kategori')
                    ->description('Detail umum tentang kategori ini.')
                    ->columns()
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Kategori'),
                        TextEntry::make('type')
                            ->label('Tipe Transaksi')
                            ->badge(),
                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),
                Section::make('Riwayat')
                    ->columns()
                    ->description('Informasi tanggal pembuatan dan pembaruan.')
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
