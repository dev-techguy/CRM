<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    /**
     * set global attributes
     */
    protected $fillable = [
        'script_id',
        'client',
        'phone_number',
        'email',
        'answer',
        'disposition',
        'appointment_date',
        'callback_date',
        'is_complete',
    ];

    /**
     * set cast
     */
    protected $casts = [
        'answer' => 'array',
        'disposition' => 'array',
    ];

    /**
     * get script
     * @return BelongsTo
     */
    public function script()
    {
        return $this->belongsTo(Script::class);
    }
}
