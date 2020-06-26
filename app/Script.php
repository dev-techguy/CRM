<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * get report
     * @return HasMany
     */
    public function report()
    {
        return $this->hasMany(Report::class);
    }
}
