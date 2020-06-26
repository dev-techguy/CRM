<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetDate extends Model
{
    /**
     * set global attributes
     */
    protected $fillable = [
        'client',
        'appointment_date',
        'callback_date',
    ];
}
