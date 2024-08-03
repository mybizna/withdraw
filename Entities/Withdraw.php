<?php

namespace Modules\Withdraw\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

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
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $this->fields->increments('id')->html('hidden');
        $this->fields->decimal('amount', 11)->html('amount');
        $this->fields->string('currency_id')->nullable()->html('recordpicker')->relation(['core', 'currency']);
        $this->fields->longText('description')->nullable()->html('text');
        $this->fields->boolean('paid_status')->nullable()->html('switch')->default(false);
        $this->fields->boolean('is_canceled')->nullable()->html('switch')->default(false);
        $this->fields->string('token')->nullable()->html('text');
        $this->fields->longText('params')->nullable()->html('textarea');
        $this->fields->bigInteger('gateway_id')->nullable()->html('recordpicker')->relation(['account', 'gateway']);
        $this->fields->integer('partner_id')->nullable()->html('recordpicker')->relation(['partner']);

    }

}
