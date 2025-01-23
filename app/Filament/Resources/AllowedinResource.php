<?php

namespace Modules\Withdraw\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Withdraw\Models\Allowedin;

class AllowedinResource extends BaseResource
{
    protected static ?string $model = Allowedin::class;

    protected static ?string $slug = 'withdraw/allowedin';

    protected static ?string $navigationGroup = 'Withdraw';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
}
