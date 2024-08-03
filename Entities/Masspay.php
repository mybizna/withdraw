<?php

namespace Modules\Withdraw\Entities;

use Illuminate\Database\Schema\Blueprint;
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
        $this->fields->string('year')->html('text');
        $this->fields->string('month')->html('text');
        $this->fields->string('date')->html('text');
        $this->fields->string('token')->nullable();
        $this->fields->boolean('is_processed')->nullable()->html('switch')->default(false);
        $this->fields->string('type')->html('text');
        $this->fields->integer('max_limit')->html('text');
        $this->fields->string('file')->html('text');

    }




  
}
