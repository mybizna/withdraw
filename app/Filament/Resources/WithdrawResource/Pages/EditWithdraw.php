<?php

namespace Modules\Withdraw\Filament\Resources\WithdrawResource\Pages;

use Modules\Withdraw\Filament\Resources\WithdrawResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWithdraw extends EditRecord
{
    protected static string $resource = WithdrawResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
