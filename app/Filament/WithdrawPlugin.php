<?php

namespace Modules\Withdraw\Filament;

use Coolsam\Modules\Concerns\ModuleFilamentPlugin;
use Filament\Contracts\Plugin;
use Filament\Panel;

class WithdrawPlugin implements Plugin
{
    use ModuleFilamentPlugin;

    public function getModuleName(): string
    {
        return 'Withdraw';
    }

    public function getId(): string
    {
        return 'withdraw';
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
