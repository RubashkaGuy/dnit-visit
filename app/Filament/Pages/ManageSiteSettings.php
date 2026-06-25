<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.manage-site-settings';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Настройки сайта';

    protected static ?string $title = 'Настройки сайта';

    protected static ?int $navigationSort = -100;

    protected static string|\UnitEnum|null $navigationGroup = 'Сайт';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(SiteSetting::current()->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Общие')
                    ->columns(2)
                    ->components([
                        TextInput::make('company_name')->label('Название компании')->required(),
                        TextInput::make('company_short')->label('Краткое (под лого)')->required(),
                        TextInput::make('logo_text_left')->label('Лого, левая часть')->maxLength(8),
                        TextInput::make('logo_text_right')->label('Лого, правая часть (акцент)')->maxLength(8),
                        Select::make('hero_variant')->label('Вариант hero-блока')->options(['a' => 'A — слева текст / справа карточка', 'b' => 'B — по центру'])->required(),
                        ColorPicker::make('accent_color')->label('Акцентный цвет')->required(),
                        Toggle::make('show_news')->label('Показывать блок новостей'),
                    ]),
                Section::make('Контакты')
                    ->columns(2)
                    ->components([
                        TextInput::make('phone')->label('Телефон')->tel(),
                        TextInput::make('phone_hours')->label('Время работы (под телефоном)'),
                        TextInput::make('email')->label('Email')->email(),
                        TextInput::make('address_office')->label('Адрес офиса')->columnSpanFull(),
                        TextInput::make('address_lab')->label('Адрес лаборатории')->columnSpanFull(),
                    ]),
                Section::make('Реквизиты и футер')
                    ->columns(2)
                    ->components([
                        TextInput::make('inn')->label('ИНН'),
                        TextInput::make('ogrn')->label('ОГРН'),
                        Textarea::make('footer_about')->label('Текст о компании в футере')->rows(3)->columnSpanFull(),
                        TextInput::make('footer_copyright')->label('Копирайт')->columnSpanFull(),
                    ]),
                Section::make('Кнопка на странице новости')
                    ->description('Кнопка-призыв на детальной странице новости. Можно отключить или поставить любую ссылку.')
                    ->columns(2)
                    ->components([
                        Toggle::make('news_cta_enabled')->label('Показывать кнопку')->inline(false)->columnSpanFull(),
                        TextInput::make('news_cta_label')->label('Текст кнопки')->placeholder('Оставить заявку'),
                        TextInput::make('news_cta_href')->label('Ссылка кнопки')
                            ->placeholder('/#zayavka, /uslugi, https://...')
                            ->helperText('Якорь, относительный путь или внешний URL'),
                        Toggle::make('news_cta_new_tab')->label('Открывать в новой вкладке')->inline(false),
                    ]),
            ])
            ->statePath('data')
            ->model(SiteSetting::current());
    }

    public function save(): void
    {
        $state = $this->form->getState();
        SiteSetting::current()->update($state);

        Notification::make()->title('Сохранено')->success()->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')->label('Сохранить')->submit('save'),
        ];
    }
}
