<?php

namespace App\Filament\Resources\Accounts\Schemas;

use App\Enums\AccountType;
use App\Enums\TransactionEntiryType;
use App\Filament\Utils\Currency;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Informasi Dasar Akun')
                    ->aside()
                    ->description('Masukkan detail utama untuk akun baru ini.')
                    ->columns(1)
                    ->schema([
                        Group::make([
                            TextInput::make('name')
                                ->label('Nama Akun')
                                ->required()
                                ->placeholder('Contoh: Rekening Tabungan'),
                            Toggle::make('is_active')
                                ->inline(false)
                                ->label('Aktif')
                                ->required()
                                ->default(true),
                        ])->columns(),
                        Select::make('type')
                            ->label('Tipe Akun')
                            ->options(AccountType::class)
                            ->disabled(fn($operation) => $operation === 'edit')
                            ->required()
                            ->placeholder('Pilih tipe akun'),
                        Select::make('normal_position')
                            ->label('Posisi Normal')
                            ->options(TransactionEntiryType::class)
                            ->required()
                            ->placeholder('Pilih posisi normal akun'),
                        TextInput::make('balance')
                            ->label('Saldo Awal')
                            ->numeric()
                            ->disabled()
                            ->default(0.0)
                            ->prefix(Currency::symbol()),
                    ]),
            ]);
    }
}
