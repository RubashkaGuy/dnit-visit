<?php

namespace App\Filament\Resources\ServiceOptions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ServiceOptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('label')->label('Подпись варианта')->required(),
            TextInput::make('sort')->label('Порядок')->required()->numeric()->default(0),
        ]);
    }
}
