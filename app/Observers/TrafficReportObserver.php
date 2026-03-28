<?php

namespace App\Observers;

use App\Mail\ReportStatusUpdated;
use App\Models\Reports\TrafficReport;
use Illuminate\Support\Facades\Mail;

class TrafficReportObserver
{
    /**
     * Handle the TrafficReport "updated" event.
     */
    public function updated(TrafficReport $report): void
    {
        if ($report->isDirty('status')) {
            $user = $report->reportedBy;

            if ($user && $user->email) {
                Mail::to($user->email)->send(new ReportStatusUpdated($report));
            }
        }
    }
}
