<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'lat',
        'lng',
        'address',
        'short_address',
        'province',
        'city',
        'district',
        'village',
        'postal_code',
        'country',
        'street',
        'street_number',
    ];

    public function traffictReports(): HasMany
    {
        return $this->hasMany(TrafficReport::class);
    }



}
