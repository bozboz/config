<?php

namespace Bozboz\Config;

use Illuminate\Support\Facades\Schema;
use Bozboz\Config\ConfigContract;

class Config implements ConfigContract
{
    protected $config;
    protected $tags;

    public function __construct()
    {
        if (Schema::hasTable('site_config')) {
            $this->config = ConfigValue::pluck('value', 'alias');
            $this->tags = Tag::with('config')->get()->pluck('config', 'name')->map(function($config) {
                return $config->pluck('value', 'alias');
            });
        } else {
            $this->config = collect();
            $this->tags = collect();
        }
    }

    public function get($alias)
    {
        return $this->config->get($alias);
    }

    public function tag($tag)
    {
        return $this->tags->get($tag);
    }
}