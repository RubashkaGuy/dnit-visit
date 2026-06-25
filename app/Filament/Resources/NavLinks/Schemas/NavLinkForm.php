<?php

namespace App\Filament\Resources\NavLinks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NavLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('label')->label('Подпись')->required(),
            TextInput::make('href')->label('Ссылка')
                ->helperText('Якорь (#uslugi), относительный путь (/novosti) или полный URL')
                ->required(),
            TextInput::make('sort')->label('Порядок')->required()->numeric()->default(0),
            Toggle::make('is_active')->label('Показывать на сайте')->default(true)->inline(false),
        ]);
    }
}
