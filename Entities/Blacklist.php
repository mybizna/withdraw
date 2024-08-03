<?php

namespace Modules\Withdraw\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Blacklist extends BaseModel
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
    protected $table = "withdraw_blacklist";

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
        $this->fields->dateTime('start_date', 6)->nullable()->html('datetime');
        $this->fields->dateTime('end_date', 6)->nullable()->html('datetime');
        $this->fields->longText('reason')->nullable()->html('textarea');
        $this->fields->integer('partner_id')->nullable()->html('recordpicker')->relation(['partner']);

    }



    
  
}
