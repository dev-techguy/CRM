<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    /**
     * set global attributes
     */
    protected $fillable = [
        'phone_number',
        'correlator',
        'sms_load',
        'is_sent',
    ];
}
