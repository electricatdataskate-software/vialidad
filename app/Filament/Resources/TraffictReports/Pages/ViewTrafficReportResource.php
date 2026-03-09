<?php

namespace App\Filament\Resources\TraffictReports\Pages;

use App\Filament\Resources\TraffictReports\TraffictReportResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTrafficReportResource extends ViewRecord
{
    protected static string $resource = TraffictReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
