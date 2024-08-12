<?php

namespace Modules\Withdraw\Models;

use Modules\Base\Models\BaseModel;

class Whitelist extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'start_date', 'end_date', 'reason', 'partner_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "withdraw_whitelist";

}
