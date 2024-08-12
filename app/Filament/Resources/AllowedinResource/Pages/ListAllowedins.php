<?php

namespace Modules\Withdraw\Filament\Resources\AllowedinResource\Pages;

use Modules\Withdraw\Filament\Resources\AllowedinResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAllowedins extends ListRecords
{
    protected static string $resource = AllowedinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
