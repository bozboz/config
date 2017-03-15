<?php

namespace Bozboz\Config\Http\Controllers;

use Bozboz\Admin\Http\Controllers\ModelAdminController;
use Bozboz\Config\ConfigValueAdminDecorator;

class SiteConfig extends ModelAdminController
{
    protected $useActions = true;
    protected $editView = 'site-config::admin.edit';

    public function __construct(ConfigValueAdminDecorator $decorator)
    {
        parent::__construct($decorator);
    }

    protected function createPermissions($stack, $instance)
    {
        $stack->add('create_site_config', $instance ? $instance->id : null);
    }

    protected function editPermissions($stack, $instance)
    {
        $stack->add('edit_site_config', $instance ? $instance->id : null);
    }

    protected function deletePermissions($stack, $instance)
    {
        $stack->add('delete_site_config', $instance ? $instance->id : null);
    }

    protected function viewPermissions($stack)
    {
        $stack->add('view_site_config');
    }
}