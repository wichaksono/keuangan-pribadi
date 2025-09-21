<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Filament\Resources\Transactions\TransactionResource;
use Filament\Resources\Pages\Page;

class Income extends Page
{
    protected static string $resource = TransactionResource::class;

    protected string $view = 'filament.resources.transactions.pages.income';
}
