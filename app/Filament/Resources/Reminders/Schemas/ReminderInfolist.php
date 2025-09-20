<?php

namespace App\Filament\Resources\Reminders\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReminderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Menggunakan Card untuk mengelompokkan entri utama
                Section::make('Informasi Utama')
                    ->columns()
                    ->schema([
                        TextEntry::make('title')
                            ->label('Judul')
                            ->placeholder('-')
                            ->columnSpanFull(),

                        TextEntry::make('description')
                            ->placeholder('-')
                            ->label('Deskripsi')
                            ->columnSpanFull(),

                        TextEntry::make('reminder_at')
                            ->date()
                            ->label('Tanggal Pengingat'),

                        IconEntry::make('is_completed')
                            ->boolean()
                            ->label('Selesai'),
                    ]),

                // Menempatkan metadata di bagian bawah
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
                    ->columns(3),
            ]);
    }
}
