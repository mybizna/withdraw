<?php
namespace Modules\Withdraw\Models;

use Base\Casts\Money;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;
use Modules\Account\Models\Gateway;
use Modules\Base\Models\BaseModel;
use Modules\Partner\Models\Partner;

class Withdraw extends BaseModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total' => Money::class, // Use the custom MoneyCast
    ];
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

        $table->integer('amount');
        $table->string('currency')->default('USD');
        $table->unsignedBigInteger('currency_id')->nullable();
        $table->longText('description')->nullable();
        $table->boolean('paid_status')->nullable()->default(false);
        $table->boolean('is_canceled')->nullable()->default(false);
        $table->string('token')->nullable();
        $table->longText('params')->nullable();
        $table->unsignedBigInteger('gateway_id')->nullable();
        $table->unsignedBigInteger('partner_id')->nullable();
    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('currency_id')->nullable()->constrained(table: 'currency_currency')->onDelete('set null');
        $table->foreign('gateway_id')->nullable()->constrained(table: 'account_gateway')->onDelete('set null');
        $table->foreign('partner_id')->nullable()->constrained(table: 'partner_partner')->onDelete('set null');
    }
}
