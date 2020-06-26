<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * set global attributes
     */
    protected $fillable = [
        'appointment_date',
    ];
}
