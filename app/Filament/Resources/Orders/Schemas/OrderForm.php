<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Product;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order Information')->schema([
                    Select::make('customer_id')
                        ->label('Customer')
                        ->relationship('customer', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Select::make('payment_method')
                        ->options([
                            'MFS' => 'bkash',
                            'cod' => 'COD (Cash on Delivery)',
                        ])
                        ->default('cod')
                        ->required(),

                    Select::make('payment_status')
                        ->options([
                            'pending' => 'Pending',
                            'paid' => 'Paid',
                            'failed' => 'Failed',
                        ])
                        ->default('pending')
                        ->required(),

                    ToggleButtons::make('status')
                        ->inline()
                        ->default('new')
                        ->required()
                        ->options([
                            'new' => 'New',
                            'processing' => 'Processing',
                            'shipped' => 'Shipped',
                            'delivered' => 'Delivered',
                            'cancelled' => 'Cancelled',
                        ])
                        ->colors([
                            'new' => 'info',
                            'processing' => 'warning',
                            'shipped' => 'success',
                            'delivered' => 'success',
                            'cancelled' => 'danger',
                        ])
                        ->icons([
                            'new' => 'heroicon-m-sparkles',
                            'processing' => 'heroicon-m-arrow-path',
                            'shipped' => 'heroicon-m-truck',
                            'delivered' => 'heroicon-m-check-badge',
                            'cancelled' => 'heroicon-m-x-circle',
                        ]),
                    TextInput::make('bkash_last_digits'),
                    TextInput::make('bkash_trx_id'),
                    Textarea::make('notes')->columnSpanFull(),
                ])->columnSpanFull(),

                Section::make('Order Items')->schema([
                    Repeater::make('items')
                        ->relationship()
                        ->live()
                        ->schema([
                            Select::make('product_id')
                                ->relationship('product', 'name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->distinct()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->columnSpan(4)
                                ->live()
                                ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                    $price = Product::find($state)?->price ?? 0;

                                    $set('unit_amount', $price);
                                    $set('total_amount', $price * ($get('quantity') ?? 1));

                                    // recalc grand total for this row change
                                    $items = $get('../../items') ?? [];
                                    $grandTotal = collect($items)->sum(fn ($i) => $i['total_amount'] ?? 0);
                                    $set('../../grand_total', $grandTotal);
                                }),

                            TextInput::make('quantity')
                                ->numeric()
                                ->required()
                                ->default(1)
                                ->minValue(1)
                                ->columnSpan(2)
                                ->live()
                                ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                    $set('total_amount', ($state ?? 0) * ($get('unit_amount') ?? 0));

                                    // recalc grand total for this row change
                                    $items = $get('../../items') ?? [];
                                    $grandTotal = collect($items)->sum(fn ($i) => $i['total_amount'] ?? 0);
                                    $set('../../grand_total', $grandTotal);
                                }),

                            TextInput::make('unit_amount')
                                ->numeric()
                                ->disabled()
                                ->dehydrated()
                                ->columnSpan(3),

                            TextInput::make('total_amount')
                                ->numeric()
                                ->disabled()
                                ->dehydrated()
                                ->columnSpan(3),
                        ])->columns(12)
                        // recalc on hydration so first product is counted
                        ->afterStateHydrated(function (Get $get, Set $set) {
                            $items = $get('items') ?? [];
                            $grandTotal = collect($items)->sum(fn ($i) => $i['total_amount'] ?? 0);
                            $set('grand_total', $grandTotal);
                        }),
                    Placeholder::make('grand_total_display')
                        ->label('Grand Total')
                        ->content(fn (Get $get) => \Illuminate\Support\Number::currency($get('grand_total') ?? 0, 'BDT')
                        ),
                    Hidden::make('grand_total')->default(0),
                ])->columnSpanFull(),
            ]);

    }
}
