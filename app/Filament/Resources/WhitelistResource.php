<?php

namespace Modules\Withdraw\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Withdraw\Models\Whitelist;

class WhitelistResource extends BaseResource
{
    protected static ?string $model = Whitelist::class;

    protected static ?string $slug = 'withdraw/whitelist';

    protected static ?string $navigationGroup = 'Withdraw';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

}
