<?php

namespace Modules\Withdraw\Models;

use Modules\Base\Models\BaseModel;
use Modules\Core\Models\Country;

class Allowedin extends BaseModel
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
    protected $table = "withdraw_allowedin";

    /**
     * Add relationship to Country
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
