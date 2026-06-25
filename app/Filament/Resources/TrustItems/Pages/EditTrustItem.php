<?php

namespace App\Filament\Resources\TrustItems\Pages;

use App\Filament\Resources\TrustItems\TrustItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTrustItem extends EditRecord
{
    protected static string $resource = TrustItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
