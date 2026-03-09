<?php

namespace App\Filament\Resources\ViolationTypes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Operation;

class ViolationTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make("name"),
                Textarea::make("description"),
                Toggle::make('is_active')
                    ->hiddenOn(Operation::Edit)
            ]);
    }
}
