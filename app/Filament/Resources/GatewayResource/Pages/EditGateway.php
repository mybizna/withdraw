<?php

namespace Modules\Withdraw\Filament\Resources\GatewayResource\Pages;

use Modules\Withdraw\Filament\Resources\GatewayResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGateway extends EditRecord
{
    protected static string $resource = GatewayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
