<?php

namespace Modules\Withdraw\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Withdraw\Models\Blacklist;

class BlacklistResource extends BaseResource
{
    protected static ?string $model = Blacklist::class;

    protected static ?string $slug = 'withdraw/blacklist';

    protected static ?string $navigationGroup = 'Withdraw';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


}
