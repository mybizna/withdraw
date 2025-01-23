<?php

namespace Modules\Withdraw\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Withdraw\Models\Setting;

class SettingResource extends BaseResource
{
    protected static ?string $model = Setting::class;

    protected static ?string $slug = 'withdraw/setting';

    protected static ?string $navigationGroup = 'Withdraw';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

}
