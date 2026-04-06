<?php

namespace App\Filament\Widgets;

use App\Models\Reports\TrafficReport;
use Filament\Widgets\Widget;

class TrafficReportMapWidget extends Widget
{
    protected string $view = 'filament.widgets.traffic-report-map-widget';
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $reports = TrafficReport::with(['location', 'violationType'])
            ->whereHas('location', fn($query) => $query->whereNotNull('lat')->whereNotNull('lng'))
            ->get()
            ->map(fn($report) => [
                'lat' => (float) $report->location->lat,
                'lng' => (float) $report->location->lng,
                'address' => $report->location->address,
                'description' => $report->description,
                'violation_type' => $report->violationType?->name ?? 'Desconocida',
                'status' => $report->status?->getLabel() ?? 'Pendiente',
                'classification' => $report->classification?->value ?? 'minor',
            ]);

        return [
            'reports' => $reports,
        ];
    }
}
