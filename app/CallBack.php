<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallBack extends Model
{
    /**
     * set global attributes
     */
    protected $fillable = [
        'next_call_date',
    ];
}
