<?php

namespace Modules\Withdraw\Entities;

use Illuminate\Database\Schema\Blueprint;
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

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $this->fields->increments('id')->html('hidden');
        $this->fields->string('id_passport')->nullable()->html('text');
        $this->fields->string('govt_pin')->nullable()->html('text');
        $this->fields->integer('partner_id')->nullable()->html('recordpicker')->relation(['partner']);
        $this->fields->bigInteger('gateway_id')->nullable()->html('recordpicker')->relation(['account', 'gateway']);
        $this->fields->longText('params')->nullable()->html('textarea');
        $this->fields->string('account')->nullable()->html('text');

    }



  
}
