<?php

namespace App\Filament\Widgets;

use App\Models\Reports\Location;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TrafficReportLocationChartWidget extends ChartWidget
{
    protected ?string $heading = 'Localidades más Reportadas';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $topLocations = Location::query()
            ->withCount('traffictReports')
            ->orderByDesc('traffict_reports_count')
            ->take(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Reportes por Localidad',
                    'data' => $topLocations->pluck('traffict_reports_count')->toArray(),
                    'backgroundColor' => [
                        'rgba(99, 102, 241, 0.8)', // Indigo
                        'rgba(139, 92, 246, 0.8)', // Violet
                        'rgba(236, 72, 153, 0.8)', // Pink
                        'rgba(244, 63, 94, 0.8)',  // Rose
                        'rgba(59, 130, 246, 0.8)', // Blue
                        'rgba(45, 212, 191, 0.8)', // Teal
                        'rgba(52, 211, 153, 0.8)', // Emerald
                        'rgba(251, 191, 36, 0.8)', // Amber
                    ],
                    'borderColor' => 'transparent',
                    'borderWidth' => 0,
                    'borderRadius' => 4,
                ],
            ],
            'labels' => $topLocations->map(function ($location) {
                return $location->city ?: ($location->district ?: ($location->village ?: 'Sin localidad'));
            })->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
