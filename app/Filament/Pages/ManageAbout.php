<?php

namespace App\Filament\Pages;

use App\Models\AboutSection;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageAbout extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.manage-about';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $navigationLabel = 'О компании';

    protected static ?string $title = 'Блок «О компании»';

    protected static ?int $navigationSort = -80;

    protected static string|\UnitEnum|null $navigationGroup = 'Сайт';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(AboutSection::current()->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Текст')
                    ->columns(2)
                    ->components([
                        TextInput::make('eyebrow')->label('Метка раздела')->columnSpanFull(),
                        Textarea::make('headline')->label('Заголовок')->rows(2)->columnSpanFull(),
                        Textarea::make('body')->label('Текст (абзацы разделяй пустой строкой)')->rows(8)->columnSpanFull(),
                    ]),
                Section::make('Цифры')
                    ->columns(2)
                    ->components([
                        TextInput::make('stat1_value')->label('1 — значение'),
                        TextInput::make('stat1_label')->label('1 — подпись'),
                        TextInput::make('stat2_value')->label('2 — значение'),
                        TextInput::make('stat2_label')->label('2 — подпись'),
                        TextInput::make('stat3_value')->label('3 — значение'),
                        TextInput::make('stat3_label')->label('3 — подпись'),
                    ]),
                Section::make('Фото')->components([
                    FileUpload::make('photo_path')->label('Фото справа от текста')->image()->disk('public')->directory('about')->maxSize(8192),
                ]),
            ])
            ->statePath('data')
            ->model(AboutSection::current());
    }

    public function save(): void
    {
        AboutSection::current()->update($this->form->getState());
        Notification::make()->title('Сохранено')->success()->send();
    }
}
