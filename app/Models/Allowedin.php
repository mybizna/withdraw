<?php
namespace Modules\Withdraw\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Models\BaseModel;
use Modules\Core\Models\Country;

class Allowedin extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'country_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "withdraw_allowedin";

    /**
     * Add relationship to Country
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function migration(Blueprint $table): void
    {
        $table->unsignedBigInteger('country_id')->nullable();

    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('country_id')->references('id')->on('core_country')->onDelete('set null');
    }
}
