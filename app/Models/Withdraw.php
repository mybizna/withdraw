<?php

namespace Modules\Withdraw\Models;

use Modules\Account\Models\Gateway;
use Modules\Base\Models\BaseModel;
use Modules\Partner\Models\Partner;

class Withdraw extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'amount', 'currency', 'description', 'paid_status', 'is_canceled', 'token', 'params', 'gateway_id', 'partner_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "withdraw_withdraw";

    /**
     * Add relationship to Gateway
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gateway()
    {
        return $this->belongsTo(Gateway::class);
    }

    /**
     * Add relationship to Partner
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

}
