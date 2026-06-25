<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('number')->label('Номер')->required()->default('01')->maxLength(4),
                TextInput::make('sort')->label('Порядок')->required()->numeric()->default(0),
                TextInput::make('title')->label('Заголовок')->required()->columnSpanFull(),
                Textarea::make('description')->label('Описание')->required()->rows(3)->columnSpanFull(),
                Textarea::make('icon_svg')->label('SVG иконка (вставь HTML svg-кода)')->rows(6)->columnSpanFull()
                    ->helperText('Готовый <svg>...</svg>. Цвет наследуется от currentColor.'),
            ])->columns(2);
    }
}
