<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //

    protected $table = 'positions';
    protected $fillable = ['position_name', 'position_lat', 'position_lng', 'position_description'];

    public function like(){
        return $this->hasOne('App\Like', 'p_id');
    }
}
