<?php

namespace App\Filament\Resources\Classifications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;

class ClassificationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                //Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('emails_to_notify')
                    ->label('Emails a notificar')
                    //->bulleted()
                    ->listWithLineBreaks()
                    ->wrap(),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
