<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventosResource\Pages;
use App\Filament\Resources\EventosResource\RelationManagers;
use App\Models\Eventos;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Schemas\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Closure;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Carbon;

class EventosResource extends Resource
{
    protected static ?string $model = Eventos::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-folder';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
            Section::make('Información general')
                ->description('Datos principales para identificar el evento o solicitud.')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('nombre')
                                ->label('Nombre del evento')
                                ->required()
                                ->maxLength(255),

                            Select::make('tipo')
                            ->label('Tipo')
                            ->options([
                                'Interno' => 'Interno',
                                'Externo' => 'Externo',
                            ])
                            ->native(false)
                            ->default('Externo')
                            ->required(),

                            Select::make('area_id')
                                ->label('Área')
                                ->relationship('area', 'nombre')
                                ->searchable()
                                ->preload()
                                ->required(),

                            TextInput::make('afluencia')
                                ->label('Afluencia estimada')
                                ->numeric()
                                ->minValue(0)
                                ->step(1)
                                ->prefix('Personas:')
                                ->default(0),
                        ]),

                    Textarea::make('descripcion')
                        ->label('Notas')
                        ->rows(2)
                        ->required()
                        ->maxLength(255),
                ]),

            Section::make('Programación y responsables')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            DateTimePicker::make('agenda')
                                ->label('Inicio evento')
                                ->displayFormat('d/m/Y H:i')
                                ->format('Y-m-d H:i:s')
                                ->native(false)
                                ->seconds(false)
                                ->required(),

                            DateTimePicker::make('fin_evento')
                                ->label('Fin evento')
                                ->displayFormat('d/m/Y H:i')
                                ->format('Y-m-d H:i:s')
                                ->native(false)
                                ->seconds(false)
                                ->afterOrEqual('agenda')
                                ->rule(function (Get $get, ?Eventos $record): Closure {
                                    return function (string $attribute, mixed $value, Closure $fail) use ($get, $record): void {
                                        $areaId = $get('area_id');
                                        $inicio = $get('agenda');
                                        $fin = $value;

                                        if (blank($areaId) || blank($inicio) || blank($fin)) {
                                            return;
                                        }

                                        $query = Eventos::query()
                                            ->where('area_id', $areaId)
                                            ->where('agenda', '<', $fin)
                                            ->where('fin_evento', '>', $inicio);

                                        if ($record?->getKey() !== null) {
                                            $query->whereKeyNot($record->getKey());
                                        }

                                        $conflicto = $query->first();

                                        if ($conflicto) {
                                            $inicioFormato = Carbon::parse($conflicto->agenda)->format('d/m/Y H:i');
                                            $finFormato = Carbon::parse($conflicto->fin_evento)->format('d/m/Y H:i');

                                            Notification::make()
                                                ->title('Conflicto de horario en el área')
                                                ->body("El evento \"{$conflicto->nombre}\" ya ocupa esta área de {$inicioFormato} a {$finFormato}.")
                                                ->danger()
                                                ->send();

                                            $fail('Ya existe un evento agendado en esta área que se empalma con el horario seleccionado.');
                                        }
                                    };
                                })
                                ->required(),

                            TextInput::make('solicitante')
                                ->label('Solicitante')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('operador')
                                ->label('Operador')
                                ->required()
                                ->maxLength(255),
                        ]),
                ]),

            Section::make('Requerimientos')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Textarea::make('requerimientos_tecnicos')
                                ->label('Requerimientos técnicos')
                                ->rows(3)
                                ->maxLength(255),

                            Textarea::make('requerimientos_sg')
                                ->label('Requerimientos SG')
                                ->rows(3)
                                ->maxLength(255),
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('area.nombre')
                    ->numeric()
                    ->searchable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('agenda')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListEventos::route('/'),
            'create' => Pages\CreateEventos::route('/create'),
            'edit' => Pages\EditEventos::route('/{record}/edit'),
        ];
    }
}
