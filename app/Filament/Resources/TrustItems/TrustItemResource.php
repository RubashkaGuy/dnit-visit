<?php

namespace App\Filament\Resources\TrustItems;

use App\Filament\Resources\TrustItems\Pages\CreateTrustItem;
use App\Filament\Resources\TrustItems\Pages\EditTrustItem;
use App\Filament\Resources\TrustItems\Pages\ListTrustItems;
use App\Filament\Resources\TrustItems\Schemas\TrustItemForm;
use App\Filament\Resources\TrustItems\Tables\TrustItemsTable;
use App\Models\TrustItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TrustItemResource extends Resource
{
    protected static ?string $model = TrustItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckBadge;

    protected static ?string $navigationLabel = 'Полоска доверия';

    protected static ?string $modelLabel = 'пункт';

    protected static ?string $pluralModelLabel = 'Полоска доверия';

    protected static string|UnitEnum|null $navigationGroup = 'Контент';

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'text';

    public static function form(Schema $schema): Schema
    {
        return TrustItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TrustItemsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTrustItems::route('/'),
            'create' => CreateTrustItem::route('/create'),
            'edit' => EditTrustItem::route('/{record}/edit'),
        ];
    }
}
