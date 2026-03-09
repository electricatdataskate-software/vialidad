<?php

namespace App\Filament\Resources\ViolationTypes;

use App\Filament\Resources\ViolationTypes\Pages\CreateViolationType;
use App\Filament\Resources\ViolationTypes\Pages\EditViolationType;
use App\Filament\Resources\ViolationTypes\Pages\ListViolationTypes;
use App\Filament\Resources\ViolationTypes\Schemas\ViolationTypeForm;
use App\Filament\Resources\ViolationTypes\Tables\ViolationTypesTable;
use App\Models\Reports\ViolationType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;


class ViolationTypeResource extends Resource
{
    protected static ?string $model = ViolationType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Tipos de denuncias';

    public static function form(Schema $schema): Schema
    {
        return ViolationTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ViolationTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListViolationTypes::route('/'),
            'create' => CreateViolationType::route('/create'),
            'edit' => EditViolationType::route('/{record}/edit'),
        ];
    }
}
