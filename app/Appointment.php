<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'vehicle_id', 'mechanic_id', 'date_pickup', 'date_dropoff', 'type',
    ];

    /**
     * The customer that made this appointment
     *
     * @access public
     * @return mixed
     */
    public function customer()
    {
        return $this->belongsTo('App\User', 'customer_id');
    }

    /**
     * The mechanic assigned to this appointment
     */
    public function mechanic()
    {
        return $this->belongsTo('App\User', 'mechanic_id');
    }

    /**
     * The vehicle assigned to this appointment
     */
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle', 'vehicle_id');
    }
}
