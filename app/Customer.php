<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends User
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The Customer's Appointments
     *
     * @return mixed
     */
    public function appointments()
    {
        return $this->hasMany('App\Appointment', 'customer_id');
    }

    /**
     * The User's Vehicles
     *
     * @return mixed
     */
    public function vehicles()
    {
        return $this->hasMany('App\Vehicle');
    }
}
