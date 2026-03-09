<?php

namespace App\Filament\Resources\TraffictReports\Tables;

use App\Enums\TrafficReportStatus;
use App\Enums\UserRole;
use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TraffictReportsTable
{

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("violationType.name")
                    ->label("Tipo de Infracción"),
                TextColumn::make("location.address")
                    ->label("Ubicación"),
                TextColumn::make('status')
                    ->badge(),

            ])
            ->stackedOnMobile()
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
