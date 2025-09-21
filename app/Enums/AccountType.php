<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum AccountType: string implements HasLabel, HasColor
{
    case ASSET     = 'asset'; // Assets include cash, accounts receivable, inventory, property, plant, equipment, etc.
    case LIABILITY = 'liability'; // Liabilities include accounts payable, loans, mortgages, etc.
    case EQUITY    = 'equity'; // Equity includes owner's equity, retained earnings, etc.
    case REVENUE   = 'revenue'; // Revenue includes sales, service income, interest income, etc.
    case EXPENSE   = 'expense'; // Expenses include cost of goods sold, salaries, rent, utilities, etc.

    public function getLabel(): string
    {
        return match ($this) {
            self::ASSET     => 'Asset',
            self::LIABILITY => 'Liability',
            self::EQUITY    => 'Equity',
            self::REVENUE   => 'Revenue',
            self::EXPENSE   => 'Expense',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::ASSET     => 'success',
            self::LIABILITY => 'danger',
            self::EQUITY    => 'primary',
            self::REVENUE   => 'warning',
            self::EXPENSE   => 'info',
        };
    }
}
