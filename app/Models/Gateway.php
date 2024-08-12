<?php

namespace Modules\Withdraw\Models;

use Modules\Base\Models\BaseModel;

class Gateway extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'label', 'instruction', 'gateway_id', 'file_structure', 'file_prefix', 'file_suffix', 'file_type', 'file_limit'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "withdraw_gateway";

}
