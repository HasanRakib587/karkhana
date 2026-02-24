<?php

namespace App\Filament\Resources\Collections\Schemas;

use App\Models\Collection;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CollectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->dehydrated(true)
                    ->unique(Collection::class, 'slug', ignoreRecord: true)
                    ->maxLength(255),
                FileUpload::make('image')
                    ->image()
                    ->disk('public_uploads')
                    ->directory('collection')
                    ->preserveFilenames(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
