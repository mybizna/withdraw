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
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = [

        'fields' => ['partner_id__name', 'gateway_id__title', 'amount'],
        'template' => "[partner_id__name] - [gateway_id__title] ([amount])",
    ];

    /**
     * List of tables names that are need in this model during migration.
     *
     * @var array<string>
     */
    public array $migrationDependancy = [];

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

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['partner_id', 'gateway_id', 'amount', 'paid_status', 'is_canceled'];
        $structure['form'] = [
            ['label' => 'Withdraw Detail', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['partner_id', 'gateway_id', 'amount', 'currency_id', 'partner_id']],
            ['label' => 'Withdraw Setting', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['token', 'partner_id', 'paid_status', 'is_canceled']],
            ['label' => 'Withraw Description', 'class' => 'col-span-full', 'fields' => ['description', 'params']],
        ];
        $structure['filter'] = ['partner_id', 'gateway_id', 'amount', 'paid_status', 'is_canceled'];
        return $structure;
    }

    /**
     * Define rights for this model.
     *
     * @return array
     */
    public function rights(): array
    {

    }

}
