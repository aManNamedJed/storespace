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
}
