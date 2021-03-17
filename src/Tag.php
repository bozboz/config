<?php

namespace Bozboz\Config;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'site_config_tags';

    protected $fillable = ['name'];

    public function config()
    {
        return $this->belongsToMany(ConfigValue::class, 'site_config_values_tags');
    }
}
