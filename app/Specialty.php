<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mechanic_id', 'type',
    ];

    /**
     * The Mechanic that owns this specialty
     *
     * @return mixed
     */
    public static function mechanic()
    {
        return $this->belongsTo('App\User', 'mechanic_id');
    }
}
