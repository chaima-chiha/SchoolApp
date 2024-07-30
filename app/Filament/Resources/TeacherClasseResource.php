<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherClasseResource\Pages;
use App\Filament\Resources\TeacherClasseResource\RelationManagers;
use App\Models\Teacher;
use App\Models\Classe;
use App\Models\TeacherClasse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;



class TeacherClasseResource extends Resource
{
    protected static ?string $model = TeacherClasse::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Teacher Classe managment';
    protected static ?string $navigationLabel = 'Teachers For Classes';
    protected static ?string $modelLabel ='Teachers For Classes association';
    protected static ?string $slug ='hello_to_teacher_class';
    protected static ?int $navigationSort= 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('Annee_Scolaire')
                    ->required()
                    ->maxLength(255),


                     Select::make('teacher_id')
                    ->label('teacher')
                    ->options(Teacher::all()->pluck('nom', 'id'))
                    ->searchable(),

                    Select::make('classe_id')
                    ->label('Classe')
                    ->options(Classe::all()->pluck('nom', 'id'))
                    ->searchable()


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Annee_Scolaire')
                    ->searchable(),
               // Tables\Columns\TextColumn::make('teacher_id'),
                Tables\Columns\TextColumn::make('teachers.nom'),
               // Tables\Columns\TextColumn::make('classe_id')
                //    ->numeric()
                //    ->sortable(),
                Tables\Columns\TextColumn::make('classes.nom'),
                Tables\Columns\TextColumn::make('classes.type')->label('specialité'),
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


                SelectFilter::make('classe_id')
                    ->relationship('classes', 'nom')
                    ->label('niveau')
                    ->searchable()
                    ->preload(),

               SelectFilter::make('classe_id')
                ->relationship('classes', 'type')
                ->label('spécialité')
                ->searchable()
                ->preload(),

                    SelectFilter::make('teacher_id')
                    ->relationship('teachers', 'nom')
                    ->searchable()
                    ->preload(),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTeacherClasses::route('/'),
            'create' => Pages\CreateTeacherClasse::route('/create'),
            'edit' => Pages\EditTeacherClasse::route('/{record}/edit'),
        ];
    }
}
