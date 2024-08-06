<?php

namespace Modules\Withdraw\Entities;

use Modules\Base\Entities\BaseModel;

class Disallowedin extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'country_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "withdraw_disallowedin";

}
