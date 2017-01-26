<?php

namespace Bozboz\Config;

use Bozboz\Admin\Base\DynamicSlugTrait;
use Bozboz\Admin\Base\Model;

class ConfigValue extends Model
{
	protected $table = 'site_config';

	protected $fillable = [
		'name',
		'alias',
		'value',
	];

	protected $nullable = ['value'];

	public static function boot()
	{
		static::creating([new static, 'generateAlias']);
	}

	public function generateAlias($instance)
	{
		$instance->alias = str_slug($instance->name, '_');
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'site_config_values_tags');
	}
}
