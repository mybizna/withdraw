<?php

namespace Modules\Withdraw\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Withdraw\Models\Masspay;

class MasspayResource extends BaseResource
{
    protected static ?string $model = Masspay::class;

    protected static ?string $slug = 'withdraw/masspay';

    protected static ?string $navigationGroup = 'Withdraw';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
}
