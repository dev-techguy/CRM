<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    /**
     * set global attributes
     */
    protected $fillable = [
        'question',
        'answers',
        'next_question',
        'dispositions',
    ];

    /**
     * set cast
     */
    protected $casts = [
        'answers' => 'array',
        'next_question' => 'array',
        'dispositions' => 'array',
    ];
}
