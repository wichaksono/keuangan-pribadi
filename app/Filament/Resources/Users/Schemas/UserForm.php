<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Dasar Pengguna')
                    ->description('Masukkan detail dasar pengguna untuk membuat akun baru.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->placeholder('Masukkan nama lengkap'),
                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->required()
                            ->placeholder('contoh@mail.com'),
                    ]),

                Section::make('Keamanan & Autentikasi')
                    ->description('Informasi terkait keamanan akun pengguna.')
                    ->schema([
                        TextInput::make('password')
                            ->label('Kata Sandi')
                            ->password()
                            ->required(fn($operation) => $operation === 'create')
                            ->dehydrated(fn($operation) => $operation === 'create' || filled($operation))
                            ->minLength(8)
                            ->placeholder('Minimal 8 karakter')
                            ->helperText(function ($operation) {
                                return $operation === 'edit' ?
                                    'Biarkan kosong untuk mempertahankan kata sandi saat ini.' : '';
                            }),
                        DateTimePicker::make('email_verified_at')
                            ->label('Tanggal Verifikasi Email')
                            ->nullable()
                            ->placeholder('Otomatis terisi saat verifikasi')
                            ->helperText('Secara otomatis terisi saat pengguna memverifikasi email.'),
                    ]),
            ]);
    }
}
