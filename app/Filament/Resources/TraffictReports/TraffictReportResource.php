<?php

namespace App\Filament\Resources\TraffictReports;

use App\Enums\Classification;
use App\Enums\TrafficReportStatus;
use App\Enums\UserRole;
use App\Filament\Resources\TraffictReports\Pages\CreateTraffictReport;
use App\Filament\Resources\TraffictReports\Pages\EditTraffictReport;
use App\Filament\Resources\TraffictReports\Pages\ListTraffictReports;
use App\Filament\Resources\TraffictReports\Pages\ViewTrafficReportResource;
use App\Filament\Resources\TraffictReports\Schemas\TraffictReportForm;
use App\Filament\Resources\TraffictReports\Tables\TraffictReportsTable;
use App\Models\Reports\TrafficReport;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Enums\Size;

class TraffictReportResource extends Resource
{
    protected static ?string $model = TrafficReport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Denuncia Vial';

    public static function form(Schema $schema): Schema
    {
        return TraffictReportForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->schema([
            Tabs::make('denuncia')
                ->tabs([
                    // INFORMACION
                    Tab::make('info')
                        ->schema([
                            Section::make('Descargo')
                                ->schema([
                                    TextEntry::make('occurred_at')->dateTime(),
                                    TextEntry::make('description'),
                                ]),
                            Section::make('Ubicacion')
                                ->schema([
                                    TextEntry::make('location.address'),
                                    ViewEntry::make('location')
                                        ->view('filament.infolists.entries.map')
                                        ->columnSpanFull()
                                ]),
                            Section::make('Denunciante')
                                ->schema([
                                    TextEntry::make('reportedBy.name'),
                                    TextEntry::make('reportedBy.email')
                                ]),

                            Section::make('Resultados de Revisión')
                                ->schema([
                                    TextEntry::make('status')
                                        ->badge(),
                                    TextEntry::make('classification')
                                        ->visible(fn($state) => $state)
                                        ->badge(),
                                    TextEntry::make('reviewedBy.name')
                                        ->label('Revisado por')
                                        ->visible(fn($state) => $state),
                                    TextEntry::make('reviewed_at')
                                        ->label('Revisado el')
                                        ->dateTime()
                                        ->visible(fn($state) => $state),
                                    TextEntry::make('review_notes')
                                        ->label('Notas de revisión')
                                        ->visible(fn($state) => $state)
                                        ->columnSpanFull(),
                                    TextEntry::make('administrative_action')
                                        ->label('Acción administrativa')
                                        ->visible(fn($state) => $state)
                                        ->columnSpanFull(),
                                ])
                                ->columns(2),

                        ])->columns(2),

                    // MEDIA
                    Tab::make('images')
                        ->label('Imagenes')
                        ->schema([
                            SpatieMediaLibraryImageEntry::make('images')
                                ->collection('evidence_images')
                        ]),

                    Tab::make('videos')
                        ->label('Videos')
                        ->schema([
                            SpatieMediaLibraryImageEntry::make('videos')
                                ->collection('evidence_videos')
                        ]),

                    Tab::make('actions')
                        ->hidden(fn() => auth()->user()->hasRole(UserRole::User->value))
                        ->label('Acciones')
                        ->schema([
                            Section::make('Acciones de Revisión')
                                ->description('Cambiar el estado de la denuncia y agregar notas de revisión.')
                                ->footerActions([
                                    Action::make('under_review')
                                        ->label('En revisión')
                                        ->color('primary')
                                        ->hidden(fn($record) => $record->status === TrafficReportStatus::UnderReview)
                                        ->action(function ($record) {
                                            $record->status = TrafficReportStatus::UnderReview;
                                            $record->save();

                                            Notification::make()
                                                ->title('Denuncia puesta en revisión')
                                                ->success()
                                                ->send();
                                        }),
                                    Action::make('reject')
                                        ->label('Rechazar')
                                        ->color('danger')
                                        ->hidden(fn($record) => $record->status === TrafficReportStatus::Rejected)
                                        ->schema([
                                            Select::make('classification')
                                                ->required()
                                                ->options(Classification::class),

                                            Textarea::make('review_notes')
                                                ->required(),

                                            Textarea::make('administrative_action')
                                                ->required(),
                                        ])
                                        ->action(function ($record, $data) {
                                            $record->classification = $data['classification'];
                                            $record->administrative_action = $data['administrative_action'];
                                            $record->review_notes = $data['review_notes'];
                                            $record->reviewed_at = now();
                                            $record->reviewed_by = auth()->id();
                                            $record->status = TrafficReportStatus::Rejected;

                                            $record->save();

                                            Notification::make()
                                                ->title('Denuncia rechazada')
                                                ->success()
                                                ->send();
                                        }),
                                    Action::make('accept')
                                        ->label('Aceptar')
                                        ->color('success')
                                        ->hidden(fn($record) => $record->status === TrafficReportStatus::Resolved)
                                        ->schema([
                                            Select::make('classification')
                                                ->required()
                                                ->options(Classification::class),

                                            Textarea::make('review_notes')
                                                ->required(),

                                            Textarea::make('administrative_action')
                                                ->required(),
                                        ])
                                        ->action(function ($record, $data) {
                                            $record->classification = $data['classification'];
                                            $record->administrative_action = $data['administrative_action'];
                                            $record->review_notes = $data['review_notes'];
                                            $record->reviewed_at = now();
                                            $record->reviewed_by = auth()->id();
                                            $record->status = TrafficReportStatus::Resolved;

                                            $record->save();

                                            Notification::make()
                                                ->title('Denuncia aceptada')
                                                ->success()
                                                ->send();
                                        })
                                ])
                        ])


                ])->columnSpanFull()
        ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()->hasRole([
            UserRole::Admin->value,
            UserRole::Supervisor->value,
        ])) {
            return $query;
        }

        return $query->where('reported_by', auth()->id());
    }

    public static function table(Table $table): Table
    {
        return TraffictReportsTable::configure($table);
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
            'index' => ListTraffictReports::route('/'),
            'create' => CreateTraffictReport::route('/create'),
            'view' => ViewTrafficReportResource::route('/{record}'),
            'edit' => EditTraffictReport::route('/{record}/edit'),
        ];
    }
}
