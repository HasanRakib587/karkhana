<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                TextInput::make('email')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->email(),

                TextInput::make('phone')
                    ->label('Phone Number')
                    ->required()
                    ->tel(),

                TextInput::make('password')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord),

                Repeater::make('Addresses')
                    ->relationship('addresses')
                    ->columns(2)
                    ->schema([
                        TextInput::make('first_name')->required(),
                        TextInput::make('last_name')->required(),
                        TextInput::make('phone')->required(),
                        Select::make('location_type')
                            ->options([
                                'inside_dhaka' => 'Inside Dhaka',
                                'outside_dhaka' => 'Outside Dhaka',
                            ])
                            ->required(),

                        Textarea::make('street_address')
                            ->required()
                            ->columnSpanFull(),

                        Toggle::make('is_default')
                            ->label('Default Address'),
                    ])->columnSpanFull(),
            ]);
    }
}
