<?php

namespace Modules\Withdraw\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Gateway extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'label', 'instruction', 'gateway_id', 'file_structure', 'file_prefix', 'file_suffix', 'file_type', 'file_limit'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['gateway_id__title'];

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
    protected $table = "withdraw_gateway";

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
        $this->fields->string('label')->html('text');
        $this->fields->longText('instruction')->html('textarea');
        $this->fields->bigInteger('gateway_id')->nullable()->html('recordpicker')->relation(['account', 'gateway']);
        $this->fields->longText('file_structure')->html('text');
        $this->fields->longText('file_prefix')->nullable()->html('text');
        $this->fields->longText('file_suffix')->nullable()->html('text');
        $this->fields->string('file_type')->nullable()->html('text');
        $this->fields->integer('file_limit')->nullable()->html('text');

    }

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['label', 'gateway_id'];
        $structure['form'] = [
            ['label' => 'Withdraw Gateway Detail', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['label', 'gateway_id', 'file_structure', 'file_prefix', 'file_suffix', 'file_type', 'file_limit']],
            ['label' => 'Withdraw Gateway Setting', 'class' => 'col-span-full', 'fields' => ['instruction']],
        ];
        $structure['filter'] = ['label', 'gateway_id'];
        return $structure;
    }
}
