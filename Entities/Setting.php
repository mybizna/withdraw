<?php

namespace Modules\Withdraw\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Setting extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'id_passport', 'govt_pin', 'partner_id', 'gateway_id', 'params', 'account'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = [
        'fields' => ['partner_id__name', 'gateway_id__title', 'id_passport'],
        'template' => "[partner_id__name] - [gateway_id__title] ([id_passport])",
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
    protected $table = "withdraw_setting";

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
        $this->fields->string('id_passport')->nullable()->html('text');
        $this->fields->string('govt_pin')->nullable()->html('text');
        $this->fields->integer('partner_id')->nullable()->html('recordpicker')->relation(['partner']);
        $this->fields->bigInteger('gateway_id')->nullable()->html('recordpicker')->relation(['account', 'gateway']);
        $this->fields->longText('params')->nullable()->html('textarea');
        $this->fields->string('account')->nullable()->html('text');

    }

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['id_passport', 'govt_pin', 'partner_id', 'gateway_id', 'params', 'account'];
        $structure['form'] = [
            ['label' => 'Withdraw Setting', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['id_passport', 'govt_pin', 'partner_id', 'gateway_id', 'account']],
            ['label' => 'Withdraw Setting Params', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['params']],
        ];
        $structure['filter'] = ['id_passport', 'govt_pin', 'partner_id', 'gateway_id', 'params', 'account'];
        return $structure;
    }

    /**
     * Define rights for this model.
     *
     * @return array
     */
    public function rights(): array
    {
        $rights = parent::rights();

        $rights['staff'] = ['view' => true];
        $rights['registered'] = ['view' => true];
        $rights['guest'] = [];

        return $rights;
    }
}
