<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->reactive() // important
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->required()
                    ->disabled()        // user can't edit
                    ->dehydrated(true)  // still saved to DB
                    ->unique(Category::class, 'slug', ignoreRecord: true)
                    ->maxLength(255),

                FileUpload::make('image')
                    ->image()
                    ->disk('public_uploads')
                    ->directory('categories')
                    ->visibility('public')
                    ->maxSize(2048)
                    // ->imageEditor()
                    ->preserveFilenames()->columns(6),
                Textarea::make('description')
                    ->required()
                    ->maxLength(255)->columns(6),
                Toggle::make('is_active')
                    ->required()
                    ->default(true),
            ]);
    }
}
