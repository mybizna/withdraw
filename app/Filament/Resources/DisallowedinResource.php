<?php

namespace Modules\Withdraw\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Withdraw\Models\Disallowedin;

class DisallowedinResource extends BaseResource
{
    protected static ?string $model = Disallowedin::class;

    protected static ?string $slug = 'withdraw/disallowedin';

    protected static ?string $navigationGroup = 'Withdraw';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

}
