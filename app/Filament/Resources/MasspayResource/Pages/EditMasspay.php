<?php

namespace Modules\Withdraw\Filament\Resources\MasspayResource\Pages;

use Modules\Withdraw\Filament\Resources\MasspayResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasspay extends EditRecord
{
    protected static string $resource = MasspayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
