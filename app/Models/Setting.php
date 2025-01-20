<?php

namespace Modules\Withdraw\Models;

use Modules\Account\Models\Gateway;
use Modules\Base\Models\BaseModel;
use Modules\Partner\Models\Partner;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * Add relationship to Gateway
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class);
    }

    /**
     * Add relationship to Partner
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }


    public function migration(Blueprint $table): void
    {


        $table->string('id_passport')->nullable();
        $table->string('govt_pin')->nullable();
        $table->unsignedBigInteger('partner_id')->nullable();
        $table->unsignedBigInteger('gateway_id')->nullable();
        $table->longText('params')->nullable();
        $table->string('account')->nullable();
    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('partner_id')->nullable()->constrained(table: 'partner_partner')->onDelete('set null');
        $table->foreign('gateway_id')->nullable()->constrained(table: 'account_gateway')->onDelete('set null');
    }
}
