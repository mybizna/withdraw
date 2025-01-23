<?php

namespace Modules\Withdraw\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Withdraw\Models\Withdraw;

class WithdrawResource extends BaseResource
{
    protected static ?string $model = Withdraw::class;

    protected static ?string $slug = 'withdraw/withdraw';

    protected static ?string $navigationGroup = 'Withdraw';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

}
