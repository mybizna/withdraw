<?php

namespace Modules\Withdraw\Filament\Resources\WhitelistResource\Pages;

use Modules\Withdraw\Filament\Resources\WhitelistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWhitelist extends EditRecord
{
    protected static string $resource = WhitelistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
