<?php

namespace Modules\Withdraw\Models;

use Modules\Base\Models\BaseModel;
use Illuminate\Database\Schema\Blueprint;

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


    public function migration(Blueprint $table): void
    {
        $table->id();

        $table->string('year');
        $table->string('month');
        $table->string('date');
        $table->string('token')->nullable();
        $table->boolean('is_processed')->nullable()->default(false);
        $table->string('type');
        $table->integer('max_limit');
        $table->string('file');

    }
}
