<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->label('Заголовок')->required()->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set, callable $get) => filled($get('slug')) ? null : $set('slug', Str::slug($state)))
                    ->columnSpanFull(),
                TextInput::make('slug')->label('URL (slug)')->required()->unique(ignoreRecord: true),
                DatePicker::make('published_at')->label('Дата публикации')->required()->displayFormat('d.m.Y'),
                Toggle::make('is_published')->label('Опубликовано')->default(true),
                FileUpload::make('image_path')->label('Изображение')->image()->disk('public')->directory('news')->maxSize(8192)->columnSpanFull(),
                Textarea::make('excerpt')->label('Краткое описание')->rows(2)->columnSpanFull(),
                Textarea::make('body')->label('Текст новости')->rows(10)->columnSpanFull(),
            ])->columns(2);
    }
}
