<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'user managment';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('user identity')
                    ->description('definir votre nom prenon')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                        ->required(),
                    Forms\Components\TextInput::make('cin')
                        ->required(),
                    Forms\Components\TextInput::make('adress') ,
                    Forms\Components\TextInput::make('ville')
                    ->required(),
                    ])->columns(2),

                    Forms\Components\FileUpload::make('avatar')
                    ->image()
                    ->directory('storage\app\public\public'),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required(),
            Forms\Components\DateTimePicker::make('email_verified_at'),
            Forms\Components\TextInput::make('password')
                ->password()
                ->required(),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('cin')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('adress')
                    ->searchable(),
                    Tables\Columns\ImageColumn::make('avatar'),

                    Tables\Columns\TextColumn::make('ville')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
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

                           SelectFilter::make('ville')
                    ->options([
                       'nabeul' => 'nabeul',
                        'tunis' => 'tunis',
                        'sousse' => 'sousse',
                    ])
                    ->attribute('ville')
                    ->searchable(),


                    SelectFilter::make('id')
                    ->label('user name')
                    ->options(User::all()->pluck('name','id'))
                    ->searchable()
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
