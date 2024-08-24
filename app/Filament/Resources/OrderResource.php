<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers\CartItemRelationManager;

use App\Models\Order;
use App\Tables\Columns\ProgressCoulmn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{

    protected static ?string $navigationGroup = 'Orders';

    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('id')
            ->label('Order ID'),

            Tables\Columns\TextColumn::make('cart_id')
                ->label('Cart ID'),

            Tables\Columns\TextColumn::make('user.name')
                ->label('Username'),

            Tables\Columns\TextColumn::make('coupon_id')
                ->label('Coupon ID')
                ->formatStateUsing(fn ($state) => $state ?? 'None'),

            Tables\Columns\TextColumn::make('note')
                ->label('Note'),

            Tables\Columns\TextColumn::make('location')
                ->label('Location'),

            Tables\Columns\TextColumn::make('deposit')
                ->label('Deposit')
                ->money('usd', true),

            Tables\Columns\TextColumn::make('total_price')
                ->label('Total Price')
                ->money('usd', true),

                TextColumn::make('order_status')
                ->label('Order Status')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'done' => 'red',
                    'inproccesing' => 'primary',
                    'sent' => 'info',
                    'deliverd' => 'success',
                    'checked' => 'danger',
                    'refused' => 'danger',
                    default => 'secondary',
                })
                ->icon(fn ($state) => match ($state) {
                    'done' => 'heroicon-s-building-storefront',
                    'inproccesing' => 'heroicon-s-cog',
                    'sent' => 'heroicon-s-paper-airplane',
                    'deliverd' => 'heroicon-s-truck',
                    'checked' => 'heroicon-s-eye',
                    'refused' => 'heroicon-s-hand-thumb-down',
                    default => null,
                }),

          

                IconColumn::make('deposit_status')
                ->boolean()
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle'),

                IconColumn::make('total_status')
                ->boolean()
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle'),

            TextColumn::make('customization_price')
                ->label('Customization Price')
                ->money('usd', true),

            TextColumn::make('customization_description')
                ->label('Customization Description'),

            TextColumn::make('total_price')
            ->label('Total Price'),
            ViewColumn::make('Items')
            ->label('Items')
            ->view('components.orderitems'),
            TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime('Y-m-d H:i:s')
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('updated_at')
                ->label('Updated At')
                ->dateTime('Y-m-d H:i:s')
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([

                ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                    ->slideOver(),
                    Tables\Actions\DeleteAction::make(),
                 ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getRelations(): array
{
    return [
        CartItemRelationManager::class,
    ];
}


    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\EditOrder::route('/{record}'),
        ];
    }
}
