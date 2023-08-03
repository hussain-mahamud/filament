<?php

namespace App\Filament\Resources;
use App\Filament\Resources\TaskResource\Pages;
use App\Models\Task;
use Closure;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('project_id')
                        ->relationship('project', 'name'),
                    Repeater::make('details')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function (Closure $set, $state) {
                                    $set('slug', Str::slug($state));
                                }),
                            TextInput::make('slug')->required(),
                            RichEditor::make('details')->required(),
                            Checkbox::make('is_active'),
                            
                        ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('project.name')->words(15)->sortable()->searchable(),
                TextColumn::make('id')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index'  => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit'   => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
