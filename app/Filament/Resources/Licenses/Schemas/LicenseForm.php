<?php

namespace App\Filament\Resources\Licenses\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LicenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->label('Заголовок')->required()->columnSpanFull(),
                TextInput::make('subtitle')->label('Подзаголовок (выдающий орган)')->columnSpanFull(),
                TextInput::make('sort')->label('Порядок')->required()->numeric()->default(0),
                FileUpload::make('image_path')->label('Скан документа')->image()->disk('public')->directory('licenses')->maxSize(8192)->columnSpanFull(),
            ])->columns(2);
    }
}
