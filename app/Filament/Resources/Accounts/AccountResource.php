<?php

namespace App\Filament\Resources\Accounts;

use App\Filament\Resources\Accounts\Pages\CreateAccount;
use App\Filament\Resources\Accounts\Pages\EditAccount;
use App\Filament\Resources\Accounts\Pages\ListAccounts;
use App\Filament\Resources\Accounts\Pages\ViewAccount;
use App\Filament\Resources\Accounts\Schemas\AccountForm;
use App\Filament\Resources\Accounts\Schemas\AccountInfolist;
use App\Filament\Resources\Accounts\Tables\AccountsTable;
use App\Models\Account;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static string | UnitEnum | null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 10;

    public static function form(Schema $schema): Schema
    {
        return AccountForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AccountInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AccountsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAccounts::route('/'),
            'create' => CreateAccount::route('/create'),
            'view' => ViewAccount::route('/{record}'),
            'edit' => EditAccount::route('/{record}/edit'),
        ];
    }
}
