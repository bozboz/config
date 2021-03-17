<?php

namespace Bozboz\Config;

use Bozboz\Admin\Base\ModelAdminDecorator;
use Bozboz\Admin\Fields\BelongsToManyField;
use Bozboz\Admin\Fields\CheckboxField;
use Bozboz\Admin\Fields\MediaBrowser;
use Bozboz\Admin\Fields\TextField;
use Bozboz\Admin\Fields\TextareaField;
use Bozboz\Admin\Media\Media;
use Bozboz\Admin\Reports\Filters\MultiOptionListingFilter;
use Bozboz\Permissions\Facades\Gate;
use Bozboz\Permissions\RuleStack;

class ConfigValueAdminDecorator extends ModelAdminDecorator
{
    public function __construct(ConfigValue $model)
    {
        parent::__construct($model);
    }

    public function getLabel($instance)
    {
        return $instance->name;
    }

    /**
     * @param  int  $id
     * @return Bozboz\Admin\Base\ModelInterface
     */
    public function findInstance($id)
    {
        return parent::findInstance($id)->load(['history' => function ($query) {
            $query->latest();
        }]);
    }

    public function getColumns($instance)
    {
        return array_filter([
            'Name' => $instance->name,
            'Alias' => $this->canCreate() ? $instance->alias : null,
            'Value' => str_limit(e($instance->value)) ?: ' '
        ]);
    }

    public function getFields($instance)
    {
        $canCreate = $this->canCreate();
        return array_filter([
            new TextField('name', [
                'disabled' => ! $canCreate ? 'disabled' : null,
            ]),
            $canCreate && $instance->exists ? new TextField('alias') : null,
            $this->valueField($instance),
            $canCreate ? new BelongsToManyField($this, $instance->tags(), [
                'key' => 'name',
                'data-tags' => 'true',
            ]) : null,
        ]);
    }

    private function valueField($instance)
    {
        if (! $instance->field_type) {
            return new TextareaField('value');
        }
        $field = $instance->field_type;
        return new $field('value');
    }

    public function getListingFilters()
    {
        return [
            new MultiOptionListingFilter('tags', $this->model->tags()->getModel()->lists('name', 'id')->all()),
        ];
    }

    public function getListRelations()
    {
        return [
            'tags' => 'name'
        ];
    }

    protected function canCreate()
    {
        $stack = new RuleStack;
        $stack->add('create_anything');
        $stack->add('create_site_config');
        return $stack->isAllowed();
    }
}
