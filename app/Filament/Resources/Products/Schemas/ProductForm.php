<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Information')->schema([
                    TextInput::make('name')
                        ->maxLength(255)
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                    TextInput::make('slug')
                        ->required()
                        ->disabled()
                        ->dehydrated(true)
                        ->maxLength(255)
                        ->unique(Product::class, 'slug', ignoreRecord: true),

                    MarkdownEditor::make('description')
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('products'),
                ])->columnSpanFull(),

                Section::make('Status')->schema([
                    TextInput::make('price')
                        ->required()
                        ->numeric()
                        ->prefix('BDT'),
                    TextInput::make('stock_quantity')
                        ->required()
                        ->numeric(),

                    Toggle::make('in_stock')
                        ->required()
                        ->default(true),

                    Toggle::make('is_active')
                        ->required()
                        ->default(true),

                    Toggle::make('is_featured')
                        ->default(false),

                    Toggle::make('on_sale')
                        ->default(false),
                ]),
                Section::make('Associations')->schema([

                    Select::make('category_id')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('category', 'name'),

                    Select::make('collection_id')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('collection', 'name'),
                ]),

                Section::make('Images')->schema([
                    FileUpload::make('images')
                        ->multiple()
                        ->disk('public_uploads')
                        ->directory('products')
                        ->preserveFilenames()
                        ->maxFiles(5)
                        ->reorderable()
                        ->panelLayout('grid'),
                ])->columnSpanFull(),
            ]);
    }
}
