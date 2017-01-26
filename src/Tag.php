<?php

namespace Bozboz\Config;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'site_config_tags';

    protected $fillable = ['name'];
}