<?php
 
 namespace App\Filament\Resources\TraffictReports\Schemas;
 
 use Fahiem\FilamentPinpoint\Pinpoint;
 use Filament\Forms\Components\DateTimePicker;
 use Filament\Forms\Components\Select;
 use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
 use Filament\Forms\Components\Textarea;
 use Filament\Forms\Components\TextInput;
 use Filament\Schemas\Schema;
 
 class TraffictReportForm
 {
     public static function configure(Schema $schema): Schema
     {
         return $schema
             ->components([
 
             Select::make('violation_type_id')
             ->label('Violation Type')
             ->relationship('violationType', 'name')
             ->required()
             ->preload()
             ->searchable(),
 
             DateTimePicker::make('occurred_at')
             ->default(now())
             ->label('Momento del echo'),
 
             Select::make('location_id')
             ->label('Location')
             ->relationship('location', 'address')
             ->searchable()
             ->createOptionForm([
                 Pinpoint::make('location')
                 ->label('Location')
                 ->defaultLocation(-34.6037, -58.3816) // Buenos Aires
                 ->defaultZoom(15)
                 ->height(400)
                 ->draggable()
                 ->searchable()
                 ->latField('lat')
                 ->lngField('lng')
                 ->addressField('address')
                 ->shortAddressField('short_address')
                 ->provinceField('province')
                 ->cityField('city')
                 ->districtField('district')
                 ->villageField('village')
                 ->postalCodeField('postal_code')
                 ->countryField('country')
                 ->streetField('street')
                 ->streetNumberField('street_number')
                 ->columnSpanFull(),
 
                 TextInput::make('lat')
                 ->label('Latitud')
                 ->required()
                 ->readOnly(),
 
                 TextInput::make('lng')
                 ->label('Longitud')
                 ->required()
                 ->readOnly(),
 
                 TextInput::make('address')
                 ->label('Dirección Detectada')
                 ->required()
                 ->readOnly()
                 ->columnSpanFull(),
             ]),
 
             Textarea::make('description')
             ->label('Description')
             ->rows(4)
             ->columnSpanFull(),
             SpatieMediaLibraryFileUpload::make('evidence_images')
             ->collection('evidence_images')
             ->multiple()
             ->image()
             ->disk('public'),
 
             SpatieMediaLibraryFileUpload::make('evidence_videos')
             ->collection('evidence_videos')
             ->multiple()
             ->disk('public'),
         ]);
     }
 }
