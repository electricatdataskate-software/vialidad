<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $fillable = [
        'name',
        'is_active',
        'description',
        'severity_level',
        'emails_to_notify'
    ];

    protected $casts = [
        'emails_to_notify' => 'array'
    ];
}
