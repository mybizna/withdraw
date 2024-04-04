<?php

/** @var \Modules\Base\Classes\Fetch\Rights $this */

/*
Allowedin.php  Disallowedin.php  Masspay.php  Whitelist.php
Blacklist.php  Gateway.php       Setting.php  Withdraw.php
*/
$this->add_right("withdraw", "withdraw", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "withdraw", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "withdraw", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "withdraw", "staff", view:true, add:true, edit:true);
$this->add_right("withdraw", "withdraw", "registered", view:true, add:true);
$this->add_right("withdraw", "withdraw", "guest", view:true, );

$this->add_right("withdraw", "gateway", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "gateway", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "gateway", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "gateway", "staff", view:true, add:true, edit:true);
$this->add_right("withdraw", "gateway", "registered", view:true, add:true);
$this->add_right("withdraw", "gateway", "guest", view:true, );

$this->add_right("withdraw", "setting", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "setting", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "setting", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "setting", "staff", view:true, add:true, edit:true);
$this->add_right("withdraw", "setting", "registered", view:true, add:true);
$this->add_right("withdraw", "setting", "guest", view:true, );

$this->add_right("withdraw", "allowedin", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "allowedin", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "allowedin", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "allowedin", "staff", view:true, add:true, edit:true);
$this->add_right("withdraw", "allowedin", "registered", view:true, add:true);
$this->add_right("withdraw", "allowedin", "guest", view:true, );

$this->add_right("withdraw", "disallowedin", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "disallowedin", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "disallowedin", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "disallowedin", "staff", view:true, add:true, edit:true);
$this->add_right("withdraw", "disallowedin", "registered", view:true, add:true);
$this->add_right("withdraw", "disallowedin", "guest", view:true, );

$this->add_right("withdraw", "masspay", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "masspay", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "masspay", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "masspay", "staff", view:true, add:true, edit:true);
$this->add_right("withdraw", "masspay", "registered", view:true, add:true);
$this->add_right("withdraw", "masspay", "guest", view:true, );

$this->add_right("withdraw", "blacklist", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "blacklist", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "blacklist", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "blacklist", "staff", view:true, add:true, edit:true);
$this->add_right("withdraw", "blacklist", "registered", view:true, add:true);
$this->add_right("withdraw", "blacklist", "guest", view:true, );

$this->add_right("withdraw", "whitelist", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "whitelist", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "whitelist", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("withdraw", "whitelist", "staff", view:true, add:true, edit:true);
$this->add_right("withdraw", "whitelist", "registered", view:true, add:true);
$this->add_right("withdraw", "whitelist", "guest", view:true, );





