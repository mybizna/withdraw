<?php

namespace Modules\Withdraw\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Blacklist extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'start_date', 'end_date', 'reason', 'partner_id'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = [
        'fields' => ['partner_id__name', 'start_date', 'end_date'],
        'template' => "[partner_id__name] ([start_date]-[end_date])",
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
    protected $table = "withdraw_blacklist";

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
        $this->fields->dateTime('start_date', 6)->nullable()->html('datetime');
        $this->fields->dateTime('end_date', 6)->nullable()->html('datetime');
        $this->fields->longText('reason')->nullable()->html('textarea');
        $this->fields->integer('partner_id')->nullable()->html('recordpicker')->relation(['partner']);

    }

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['start_date', 'end_date', 'reason', 'partner_id'];
        $structure['form'] = [
            ['label' => 'Withdraw Blacklist', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['start_date', 'end_date', 'reason', 'partner_id', 'partner_id']],
        ];
        $structure['filter'] = ['start_date', 'end_date', 'reason', 'partner_id'];
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
