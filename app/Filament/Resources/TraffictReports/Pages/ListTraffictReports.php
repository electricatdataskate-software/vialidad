<?php

namespace App\Filament\Resources\TraffictReports\Pages;

use App\Filament\Resources\TraffictReports\TraffictReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTraffictReports extends ListRecords
{
    protected static string $resource = TraffictReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
