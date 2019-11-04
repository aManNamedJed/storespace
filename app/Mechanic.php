<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mechanic extends User
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The Mechanic's Appointments
     *
     * @return mixed
     */
    public function appointments()
    {
        return $this->hasMany('App\Appointment', 'mechanic_id');
    }

    /**
     * The Mechanic's Specialties.
     *
     * @return mixed
     */
    public function specialties()
    {
        return $this->hasMany('App\Speciality');
    }
}
