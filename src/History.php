<?php

namespace Bozboz\Config;

use Bozboz\Admin\Users\User;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'site_config_history';

    public function getFillable()
    {
        return [
            'config_id',
            'user_id',
            'old',
            'new',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserNameAttribute()
    {
        if ($this->user) {
            return "{$this->user->first_name} {$this->user->last_name}";
        }
        return 'Unknown';
    }

    public function getDecodedNewAttribute()
    {
        return json_decode($this->new);
    }
}
