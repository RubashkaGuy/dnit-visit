<?php

namespace App\Filament\Resources\ContactRequests\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Имя')->required(),
                TextInput::make('phone')->label('Телефон')->tel()->required(),
                TextInput::make('service')->label('Услуга')->columnSpanFull(),
                Textarea::make('message')->label('Комментарий')->rows(4)->columnSpanFull(),
                Select::make('status')->label('Статус')->required()->default('new')->options([
                    'new' => 'Новая',
                    'in_progress' => 'В работе',
                    'done' => 'Обработана',
                    'spam' => 'Спам',
                ]),
            ])->columns(2);
    }
}
