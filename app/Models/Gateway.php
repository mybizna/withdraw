<?php

namespace Modules\Withdraw\Models;

use Modules\Account\Models\Gateway as AccGateway;
use Modules\Base\Models\BaseModel;
use Modules\Withdraw\Models\Setting;

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

    /**
     * Adding relationship to Setting
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    /**
     * Adding relationship to Gateway
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gateway()
    {
        return $this->belongsTo(AccGateway::class);
    }

}
