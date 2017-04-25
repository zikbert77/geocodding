<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    public function positions()
    {
        return $this->belongsTo('App\Position');
    }

}
