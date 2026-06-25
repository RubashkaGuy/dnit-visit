<?php

namespace App\Filament\Pages;

use App\Models\HeroBlock;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageHero extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.manage-hero';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static ?string $navigationLabel = 'Главный блок (Hero)';

    protected static ?string $title = 'Главный блок (Hero)';

    protected static ?int $navigationSort = -90;

    protected static string|\UnitEnum|null $navigationGroup = 'Сайт';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(HeroBlock::current()->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Контент')
                    ->columns(2)
                    ->components([
                        Select::make('variant')->label('Вариант')->options(['a' => 'A', 'b' => 'B'])->required()->columnSpanFull(),
                        TextInput::make('badge_text')->label('Бейдж сверху')->columnSpanFull(),
                        Textarea::make('headline')->label('Заголовок (переносы строк сохраняются)')->rows(3)->columnSpanFull(),
                        Textarea::make('subtitle')->label('Подзаголовок')->rows(3)->columnSpanFull(),
                    ]),
                Section::make('Кнопки')
                    ->columns(2)
                    ->components([
                        TextInput::make('cta_primary_label')->label('Текст кнопки 1'),
                        TextInput::make('cta_primary_href')->label('Ссылка кнопки 1'),
                        TextInput::make('cta_secondary_label')->label('Текст кнопки 2'),
                        TextInput::make('cta_secondary_href')->label('Ссылка кнопки 2'),
                    ]),
                Section::make('Статистика (карточка справа / снизу)')
                    ->columns(2)
                    ->components([
                        TextInput::make('stats_caption')->label('Подпись над статистикой')->columnSpanFull(),
                        TextInput::make('stat1_value')->label('1 — значение'),
                        TextInput::make('stat1_label')->label('1 — подпись'),
                        TextInput::make('stat2_value')->label('2 — значение'),
                        TextInput::make('stat2_label')->label('2 — подпись'),
                        TextInput::make('stat3_value')->label('3 — значение'),
                        TextInput::make('stat3_label')->label('3 — подпись'),
                        TextInput::make('stat4_value')->label('4 — значение'),
                        TextInput::make('stat4_label')->label('4 — подпись'),
                        TextInput::make('stats_footer_text')->label('Подпись под статистикой')->columnSpanFull(),
                    ]),
            ])
            ->statePath('data')
            ->model(HeroBlock::current());
    }

    public function save(): void
    {
        HeroBlock::current()->update($this->form->getState());
        Notification::make()->title('Сохранено')->success()->send();
    }
}
