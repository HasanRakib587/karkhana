<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('# Order')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('grand_total')
                    ->numeric()
                    ->sortable()
                    ->money('BDT'),

                TextColumn::make('payment_status')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('bkash_last_digits')
                    ->label('bKash digit')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('confirmation_email_sent')
                    ->label('Email Sent')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

                SelectColumn::make('status')
                    ->label('Order Status')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])->searchable()->sortable(),

                TextColumn::make('created_at')
                    ->label('Ordered')
                    ->date('j M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')->since()
                    ->label('Updated')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('sendConfirmation')
                    ->label('Send Email')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->modalHeading('Send payment confirmation email?')
                    ->visible(fn ($record) => filled($record->bkash_last_digits)
                        && ! $record->confirmation_email_sent
                    )
                    ->disabled(fn ($record) => $record->confirmation_email_sent
                    )
                    ->action(function ($record) {

                        // Mail::to($record->customer->email)
                        //     ->send(new \App\Mail\PaymentConfirmedMail($record));

                        $record->update([
                            'confirmation_email_sent' => true,
                            'confirmation_email_sent_at' => now(),
                            'payment_status' => 'paid',
                        ]);

                        Notification::make()
                            ->title('Confirmation email sent')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
