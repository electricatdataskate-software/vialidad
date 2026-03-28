<?php

namespace App\Models\Reports;

use App\Enums\Classification;
use App\Enums\TrafficReportStatus;
use App\Models\Reports\Traits\HasMediaFiles;
use App\Models\Reports\Traits\HasTrafficReportRelations;
use App\Policies\TrafficReportPolicies;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

#[UsePolicy(TrafficReportPolicies::class)]
class TrafficReport extends Model implements HasMedia
{
    
    use HasMediaFiles;
    use HasTrafficReportRelations;

    protected $fillable = [
        'violation_type_id',
        'reported_by',
        'location_id',
        'occurred_at',
        'description',
        'status',
        'classification',
        'administrative_action',
        'reviewed_by',
        'reviewed_at',
        'review_notes',
    ];

    protected $casts = [
        'status' => TrafficReportStatus::class,
        'classification' => Classification::class,
        'occurred_at' => 'datetime',
    ];
}
