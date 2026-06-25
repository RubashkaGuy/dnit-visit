<?php

namespace App\Filament\Resources\ServiceOptions\Pages;

use App\Filament\Resources\ServiceOptions\ServiceOptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceOption extends EditRecord
{
    protected static string $resource = ServiceOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
