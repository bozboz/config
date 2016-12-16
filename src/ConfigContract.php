<?php

namespace Bozboz\Config;

interface ConfigContract
{
    /**
     * Get config value by alias
     * @param  string $alias
     * @return string
     */
    public function get($alias);
}
