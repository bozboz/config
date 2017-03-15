<?php

namespace Bozboz\Config;

use Bozboz\Admin\Base\DynamicSlugTrait;
use Bozboz\Admin\Base\Model;
use Bozboz\Config\History;

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
		static::saved([new static, 'logHistory']);
	}

	public function generateAlias($instance)
	{
		$instance->alias = str_slug($instance->name);
	}

	public function logHistory($instance)
	{
		if ($instance->isDirty()) {
			$instance->load('tags');
			$old = $instance->getOriginal();
			$instance->history()->create([
				'user_id' => auth()->user()->id,
				'old' => $old ? $old['value'] : '',
				'new' => $instance->value,
			]);
		}
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'site_config_values_tags');
	}

	public function history()
	{
		return $this->hasMany(History::class, 'config_id');
	}
}
