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
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = [
        'fields' => ['year', 'month', 'token'],
        'template' => "[year] [month] ([token])",
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

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['year', 'month', 'date', 'token', 'is_processed', 'type', 'max_limit'];
        $structure['form'] = [
            ['label' => 'Withdraw Masspay Detail', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['year', 'month', 'date', 'token']],
            ['label' => 'Withdraw Masspay Setting', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['is_processed', 'type', 'max_limit', 'file']],
        ];
        $structure['filter'] = ['year', 'month', 'date', 'token', 'is_processed', 'type'];
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
