<?php

namespace App\Filament\Resources\ServiceOptions;

use App\Filament\Resources\ServiceOptions\Pages\CreateServiceOption;
use App\Filament\Resources\ServiceOptions\Pages\EditServiceOption;
use App\Filament\Resources\ServiceOptions\Pages\ListServiceOptions;
use App\Filament\Resources\ServiceOptions\Schemas\ServiceOptionForm;
use App\Filament\Resources\ServiceOptions\Tables\ServiceOptionsTable;
use App\Models\ServiceOption;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ServiceOptionResource extends Resource
{
    protected static ?string $model = ServiceOption::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedListBullet;

    protected static ?string $navigationLabel = 'Варианты услуг в форме';

    protected static ?string $modelLabel = 'вариант';

    protected static ?string $pluralModelLabel = 'Варианты услуг в форме';

    protected static string|UnitEnum|null $navigationGroup = 'Заявки';

    protected static ?int $navigationSort = 20;

    protected static ?string $recordTitleAttribute = 'label';

    public static function form(Schema $schema): Schema
    {
        return ServiceOptionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceOptionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceOptions::route('/'),
            'create' => CreateServiceOption::route('/create'),
            'edit' => EditServiceOption::route('/{record}/edit'),
        ];
    }
}
