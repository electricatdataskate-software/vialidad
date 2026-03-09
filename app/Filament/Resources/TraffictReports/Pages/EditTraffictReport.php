<?php

namespace App\Filament\Resources\TraffictReports\Pages;

use App\Filament\Resources\TraffictReports\TraffictReportResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTraffictReport extends EditRecord
{
    protected static string $resource = TraffictReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
