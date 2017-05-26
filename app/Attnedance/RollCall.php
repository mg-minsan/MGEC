<?php

namespace App\Attendance;

use Illuminate\Database\Eloquent\Model;

class RollCall extends Model
{
    /**
     * undocumented function
     *
     * @return void
     */
    protected $fillable = ['date', 'trip_i  d']; 

    public function attendances()
    {
        return $this->belongsToMany('App\Attendance\Attendance');
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function  trip()
    {
        return $this->belongsTo('App\Attendance\Trip');
    }
    
    
}
