<?php

namespace App\Filament\Resources\TeacherClasseResource\Pages;

use App\Filament\Resources\TeacherClasseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeacherClasse extends EditRecord
{
    protected static string $resource = TeacherClasseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
