<?php

namespace Bozboz\Config;

use Illuminate\Support\Facades\Schema;
use Bozboz\Config\ConfigContract;

class Config implements ConfigContract
{
    protected $config;

    public function __construct()
    {
        if (Schema::hasTable('site_config')) {
            $this->config = ConfigValue::pluck('value', 'alias');
        } else {
            $this->config = collect();
        }
    }

    public function get($alias)
    {
        return $this->config->get($alias);
    }
}