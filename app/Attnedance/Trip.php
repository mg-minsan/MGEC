<?php

namespace App\Attendance;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function rollCalls()
    {
        return $this->hasMany('App\Attendance\RollCall');
    }
    
}
