<?php

namespace Modules\Withdraw\Filament\Resources\BlacklistResource\Pages;

use Modules\Withdraw\Filament\Resources\BlacklistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlacklist extends EditRecord
{
    protected static string $resource = BlacklistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
