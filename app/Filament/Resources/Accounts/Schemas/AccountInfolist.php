<?php

namespace App\Filament\Resources\Accounts\Schemas;

use App\Filament\Utils\Currency;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AccountInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Akun')
                    ->description('Detail dasar untuk akun ini.')
                    ->schema([
                        Group::make([
                            TextEntry::make('name')
                                ->label('Nama Akun')
                                ->placeholder('-'),
                            TextEntry::make('type')
                                ->badge()
                                ->label('Tipe Akun'),
                            IconEntry::make('is_active')
                                ->label('Status')
                                ->boolean(),
                        ])->columns(3),
                        TextEntry::make('balance')
                            ->label('Saldo')
                            ->numeric(decimalPlaces: 2)
                            ->prefix(Currency::symbol())
                            ->placeholder('-'),

                    ]),

                Section::make('Riwayat')
                    ->description('Informasi terkait pembuatan dan pembaruan akun.')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('creator.name')
                            ->label('Dibuat Oleh')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('created_at')
                            ->label('Tanggal Dibuat')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->label('Terakhir Diperbarui')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
