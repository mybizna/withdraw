<?php

namespace Modules\Withdraw\Filament\Resources\MasspayResource\Pages;

use Modules\Withdraw\Filament\Resources\MasspayResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasspays extends ListRecords
{
    protected static string $resource = MasspayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
