<?php

namespace App\Models\Reports;

use App\Policies\ViolationTypePolicies;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[UsePolicy(ViolationTypePolicies::class)]
class ViolationType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function trafficReports(): HasMany
    {
        return $this->hasMany(TrafficReport::class);
    }
}
