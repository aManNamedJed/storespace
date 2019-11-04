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
        'make', 'model', 'color', 'year', 'description', 'customer_id',
    ];

    /**
     * The user that owns the Vehicle
     *
     * @return mixed
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    /**
     * The appointments for this Vehicle
     *
     * @return mixed
     */
    public function appointments()
    {
        return $this->hasMany('App\Appointment', 'appointment_id');
    }
}
