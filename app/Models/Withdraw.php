<?php

namespace Modules\Withdraw\Models;

use Modules\Account\Models\Gateway;
use Modules\Base\Models\BaseModel;
use Modules\Partner\Models\Partner;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        $table->id();

        $table->decimal('amount', 11);
        $table->foreignId('currency_id')->nullable()->constrained(table: 'core_currency')->onDelete('set null');
        $table->longText('description')->nullable();
        $table->boolean('paid_status')->nullable()->default(false);
        $table->boolean('is_canceled')->nullable()->default(false);
        $table->string('token')->nullable();
        $table->longText('params')->nullable();
        $table->foreignId('gateway_id')->nullable()->constrained(table: 'account_gateway')->onDelete('set null');
        $table->foreignId('partner_id')->nullable()->constrained(table: 'partner_partner')->onDelete('set null');

    }
}
