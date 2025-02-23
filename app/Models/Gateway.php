<?php
namespace Modules\Withdraw\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Schema\Blueprint;
use Modules\Account\Models\Gateway as AccGateway;
use Modules\Base\Models\BaseModel;
use Modules\Withdraw\Models\Setting;

class Gateway extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'label', 'instruction', 'gateway_id', 'file_structure', 'file_prefix', 'file_suffix', 'file_type', 'file_limit'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "withdraw_gateway";

    /**
     * Adding relationship to Setting
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings(): HasMany
    {
        return $this->hasMany(Setting::class);
    }

    /**
     * Adding relationship to Gateway
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gateway(): BelongsTo
    {
        return $this->belongsTo(AccGateway::class);
    }

    public function migration(Blueprint $table): void
    {

        $table->string('label');
        $table->longText('instruction');
        $table->unsignedBigInteger('gateway_id')->nullable();
        $table->longText('file_structure');
        $table->longText('file_prefix')->nullable();
        $table->longText('file_suffix')->nullable();
        $table->string('file_type')->nullable();
        $table->integer('file_limit')->nullable();

    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('gateway_id')->references('id')->on('account_gateway')->onDelete('set null');
    }
}
