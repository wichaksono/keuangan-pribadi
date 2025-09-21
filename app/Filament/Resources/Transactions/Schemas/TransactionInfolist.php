<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Filament\Utils\Currency;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
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
                        ->columns()
                        ->schema([
                            TextEntry::make('title')
                                ->label('Judul'),
                            TextEntry::make('date')
                                ->date()
                                ->label('Tanggal'),
                            TextEntry::make('description')
                                ->placeholder('-')
                                ->label('Deskripsi')
                                ->columnSpanFull(),

                        ]),


                    Section::make('Entri Transaksi')
                        ->schema([
                            RepeatableEntry::make('entries')
                                ->hiddenLabel()
                                ->contained(false)
                                ->schema([
                                    TextEntry::make('account.name')
                                        ->label('Akun'),
                                    TextEntry::make('type')
                                        ->badge()
                                        ->label('Tipe'),
                                    TextEntry::make('amount')
                                        ->numeric()
                                        ->prefix(Currency::symbol())
                                        ->label('Jumlah'),
                                ])->columns(3)
                                ->columnSpanFull(),
                        ])
                        ->columns(2),
                ])->columnSpan(2),

                Section::make('Metadata')
                    ->columns()
                    ->schema([
                        ImageEntry::make('attachments')
                            ->placeholder('-')
                            ->label('Lampiran')
                            ->columnSpanFull(),
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
