<?php

namespace Bozboz\Config;

use Bozboz\Config\ConfigContract;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class Config implements ConfigContract
{
    protected $config;
    protected $tags;

    public function clearCache()
    {
        Cache::forget('siteConfig:config');
        Cache::forget('siteConfig:tags');
    }

    public function get($alias = null)
    {
        if (! $this->config) {
            $this->loadConfig();
        }
        return $alias ? $this->config->get($alias) : $this->config;
    }

    public function tag($tag)
    {
        if (! $this->tags) {
            $this->loadTags();
        }
        return $this->tags->get($tag);
    }

    private function loadConfig()
    {
        $this->config = Cache::rememberForever('siteConfig:config', function () {
            return ConfigValue::pluck('value', 'alias');
        });
    }

    private function loadTags()
    {
        $this->tags = Cache::rememberForever('siteConfig:tags', function () {
            return Tag::with('config')->get()->pluck('config', 'name')->map(function ($config) {
                return $config->pluck('value', 'alias');
            });
        });
    }
}
