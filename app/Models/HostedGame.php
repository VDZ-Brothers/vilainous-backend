<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostedGame extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'password', 'host_id'];
    public function users(){
        return $this->hasMany(User::class, 'game_id');
    }
}
