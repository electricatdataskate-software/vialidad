<?php

namespace App\Filament\Resources\TraffictReports\Pages;

use App\Filament\Resources\TraffictReports\TraffictReportResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTraffictReport extends CreateRecord
{
    protected static string $resource = TraffictReportResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['reported_by'] = auth()->id();
        return $data;
    }

    public function canCreateAnother(): bool
    {
        return false;
    }
}
