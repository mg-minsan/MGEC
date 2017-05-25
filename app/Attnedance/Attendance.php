<?php

namespace App\Attendance;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{

	protected $fillable = ['name'];
    /**
     * undocumented function
     *
     * @return void
     */

    public function rollCalls()
    {
        return $this->belongsToMany('App\Attendance\RollCall');
    }
    
}
