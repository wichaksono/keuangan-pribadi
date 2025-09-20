<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Filament\Utils\Currency;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                // Mengelompokkan judul dan deskripsi dalam satu section

                Group::make([
                    Section::make('Informasi Dasar')
                        ->columns(1)
                        ->schema([
                            TextEntry::make('title')
                                ->label('Judul'),
                            TextEntry::make('description')
                                ->placeholder('-')
                                ->label('Deskripsi'),
                            Group::make([
                                TextEntry::make('amount')
                                    ->numeric()
                                    ->prefix(Currency::symbol())
                                    ->label('Jumlah'),
                                TextEntry::make('type')
                                    ->badge()
                                    ->label('Tipe'),
                                TextEntry::make('date')
                                    ->date()
                                    ->label('Tanggal'),
                            ])->columns(3)
                        ]),


                    Section::make('Kategori dan Akun')
                        ->schema([
                            TextEntry::make('category.name')
                                ->label('Kategori'),
                            TextEntry::make('account.name')
                                ->label('Akun'),
                        ])
                        ->columns(2),

                    // Mengelompokkan metadata seperti lampiran
                    Section::make('Detail Transaksi')
                        ->schema([
                            ImageEntry::make('attachments')
                                ->placeholder('-')
                                ->label('Lampiran'),
                        ])
                        ->columns(1),
                ])->columnSpan(2),

                Section::make('Metadata')
                    ->columns()
                    ->schema([
                        TextEntry::make('creator.name')
                            ->numeric()
                            ->label('Dibuat Oleh')
                            ->columnSpanFull(),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-')
                            ->label('Dibuat pada'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-')
                            ->label('Diperbarui pada'),
                    ])
                    ->columns(),
            ]);
    }
}
