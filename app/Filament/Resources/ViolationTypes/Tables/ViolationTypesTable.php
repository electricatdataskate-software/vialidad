<?php

namespace App\Filament\Resources\ViolationTypes\Tables;

use App\Notifications\UpdateReportStatusSimpleUser;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ViolationTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name"),
                ToggleColumn::make('is_active')
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('email')
                    ->action(function ($record) {
                        auth()->user()->notify(new UpdateReportStatusSimpleUser($record));
                    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
