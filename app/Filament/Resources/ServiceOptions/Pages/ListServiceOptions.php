<?php

namespace App\Filament\Resources\ServiceOptions\Pages;

use App\Filament\Resources\ServiceOptions\ServiceOptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServiceOptions extends ListRecords
{
    protected static string $resource = ServiceOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
