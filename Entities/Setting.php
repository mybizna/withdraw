<?php

namespace Modules\Withdraw\Entities;

use Modules\Base\Entities\BaseModel;

class Setting extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'id_passport', 'govt_pin', 'partner_id', 'gateway_id', 'params', 'account'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "withdraw_setting";

}
