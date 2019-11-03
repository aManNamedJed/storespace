<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'make', 'model', 'color', 'year', 'customer_id',
    ];

    /**
     * The user that owns the Vehicle
     *
     * @access public
     * @return mixed
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    /**
     * The appointments for this Vehicle
     *
     * @access public
     * @return mixed
     */
    public function appointments()
    {
        return $this->hasMany('App\Appointment', 'appointment_id');
    }
}
