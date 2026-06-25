<?php

namespace App\Filament\Resources\TrustItems\Pages;

use App\Filament\Resources\TrustItems\TrustItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTrustItems extends ListRecords
{
    protected static string $resource = TrustItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
