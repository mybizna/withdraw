<?php

namespace Modules\Withdraw\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Allowedin extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = [ 'id', 'country_id', ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "withdraw_allowedin";

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $this->fields->increments('id' )->html('hidden');
        $this->fields->bigInteger('country_id')->nullable()->html('recordpicker')->relation(['core', 'country']);

    }

 

 
}
