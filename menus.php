<?php

/** @var \Modules\Base\Classes\Fetch\Menus $this */

$this->add_module_info("withdraw", [
    'title' => 'Withdraw',
    'description' => 'Withdraw',
    'icon' => 'fas fa-people-arrows',
    'path' => '/withdraw/admin/withdraw',
    'class_str' => 'text-primary border-primary',
    'position' => 1,
]);

//$this->add_menu("module", "key", "title","path", "icon", "position");
$this->add_menu("withdraw", "withdraw", "Transfer", "/withdraw/admin/withdraw", "fas fa-cogs", 1);
$this->add_menu("withdraw", "allowedin", "Allowed In", "/withdraw/admin/allowedin", "fas fa-cogs", 1);
$this->add_menu("withdraw", "disallowedin", "Disallowed In", "/withdraw/admin/disallowedin", "fas fa-cogs", 1);
$this->add_menu("withdraw", "blacklist", "Blacklist", "/withdraw/admin/blacklist", "fas fa-cogs", 1);
$this->add_menu("withdraw", "whitelist", "Whitelist", "/withdraw/admin/whitelist", "fas fa-cogs", 1);


