<?php

namespace App\Models\Reports\Traits;

use App\Models\Reports\Location;
use App\Models\Reports\ViolationType;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasTrafficReportRelations
{
    public function reportedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function violationType(): BelongsTo
    {
        return $this->belongsTo(ViolationType::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
