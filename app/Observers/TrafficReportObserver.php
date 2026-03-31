<?php

namespace App\Observers;

use App\Mail\ReportStatusUpdated;
use App\Models\Reports\TrafficReport;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NotifyUpdateReportStatusSimpleUser;

class TrafficReportObserver
{
    /**
     * Handle the TrafficReport "updated" event.
     */
    public function updated(TrafficReport $report): void
    {
        if (!$report->wasChanged('status')) return;

        $report->refresh();


        if ($report->reportedBy) {
            $report->reportedBy->notify(
                new NotifyUpdateReportStatusSimpleUser($report)
            );
        }

        if ($report->classification?->emails_to_notify) {
            foreach ($report->classification->emails_to_notify as $email) {
                Mail::to($email)
                    ->send(new ReportStatusUpdated($report));
            }
        }
    }
    public function created(TrafficReport $report): void
    {
        $report->reportedBy->notify(new NotifyUpdateReportStatusSimpleUser($report));
    }
}
