<?php

namespace App\Filament\Resources\TrustItems\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TrustItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('text')->label('Текст пункта')->required(),
            TextInput::make('sort')->label('Порядок')->required()->numeric()->default(0),
        ]);
    }
}
