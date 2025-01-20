<?php

namespace Modules\Withdraw\Models;

use Modules\Base\Models\BaseModel;
use Modules\Partner\Models\Partner;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Whitelist extends BaseModel
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
    protected $table = "withdraw_whitelist";

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


        $table->dateTime('start_date')->nullable();
        $table->dateTime('end_date')->nullable();
        $table->longText('reason')->nullable();
        $table->unsignedBigInteger('partner_id')->nullable();
    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('partner_id')->references('id')->on('partner_partner')->onDelete('set null');
    }
}
