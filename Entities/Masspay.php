<?php

namespace Modules\Withdraw\Entities;

use Modules\Base\Entities\BaseModel;

class Masspay extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'year', 'month', 'date', 'token', 'is_processed', 'type', 'max_limit', 'file'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "withdraw_masspay";

}
