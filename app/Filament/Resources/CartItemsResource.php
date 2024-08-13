<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CartItemsResource\Pages;
use App\Filament\Resources\CartItemsResource\RelationManagers;
use App\Models\CartItem;
use App\Models\User;
use App\Models\Cart;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Order;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select; 
use Illuminate\Support\Facades\DB;
use Filament\Tables\Actions\ActionGroup;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CartItemsResource extends Resource
{
    protected static ?string $model = CartItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        {
            return $form
                ->schema([
                    Forms\Components\Select::make('product_id')
                        ->label('Product')
                        ->options(\App\Models\Product::all()->pluck('name', 'id'))
                        ->required(),
    
                    Forms\Components\Select::make('user_id')
                        ->label('User')
                        ->options(\App\Models\User::all()->pluck('name', 'id'))
                        ->required(),
                        
                    Forms\Components\Select::make('cart_id')
                    ->label('cart')
                    ->options(\App\Models\Cart::all()->pluck('id' , 'id'))
                    ->required(),

    
                        Select::make('color')
                        ->options(DB::table('colors')->pluck('color', 'id'))
                        ->preload()
                        ->searchable()
    
                        ->label('Colors'),
                        Forms\Components\TextInput::make('color_price')
                        ->label('Color Price')
                        ->numeric()
                        ->required()
                        ->nullable(),
    
                        
        
                    Select::make('size')
                        ->options(DB::table('sizes')->pluck('size', 'id'))
                        ->preload()
                        ->searchable()
                        ->required()
                        ->label('Sizes'),
                            
                    Forms\Components\TextInput::make('size_price')
                    ->label('Size Price')
                    ->numeric()
                    ->nullable(),
        
                    Select::make('addition')
                        ->options(DB::table('additions')->pluck('addition', 'id'))
                        ->preload()        
                        ->searchable()
                        ->required()
                        ->label('Additions'),
    
           
    
                    Forms\Components\TextInput::make('addition_price')
                        ->label('Addition Price')
                        ->numeric()
                        ->nullable(),
                ]);
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                ->label('User'),
                TextColumn::make('product.name')
                ->label('Product Name'),

              TextColumn::make('product.description')
                ->label('Product Description'),

              TextColumn::make('product.base_price')
                ->label('Base Price'),
             

                TextColumn::make('color')
                ->label('Colors')
                ->formatStateUsing(function ($record) {
                    $colorId = $record->color; 
                    if ($colorId) {
                        $hexCode = DB::table('colors')->where('id', $colorId)->value('hex');
                        if ($hexCode) {
                            return "<span style='display: inline-block; width: 24px; margin:1px; height: 24px; border-radius: 50%; background-color: {$hexCode};'></span>";
                        } else {
                            return 'Color not found';
                        }
                    } else {
                        return 'No color selected';
                    }
                })
                ->html(),


                TextColumn::make('size')
                ->label('Size')
                ->formatStateUsing(function ($state) {
                    if ($state) {
                        $sizeName = DB::table('sizes')->where('id', $state)->value('size');
                        return $sizeName ?: 'Size not found';
                    }
                    return 'No size selected';
                }),

                TextColumn::make('addition')
                ->label('addition')
                ->formatStateUsing(function ($state) {
                    if ($state) {
                        $addition = DB::table('additions')->where('id', $state)->value('addition');
                        return $addition ?: 'Size not found';
                    }
                    return 'No size selected';
                }),

                    TextColumn::make('color_price')
                    ->label('Color Price'),

                    TextColumn::make('size_price')
                    ->label('Size Price'),

                    TextColumn::make('addition_price')
                    ->label('Addition Price'),
                    TextColumn::make('total_item_price')
                    ->label('Total Item Price')
                    ->getStateUsing(function ($record) {
                        return $record->product->base_price + $record->color_price + $record->size_price + $record->addition_price;
                    })
                    ->formatStateUsing(fn ($state) => number_format($state, 2))
                    ->label('Total Price'),
                
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
            //
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCartItems::route('/'),
            'create' => Pages\CreateCartItems::route('/create'),
            // 'edit' => Pages\EditCartItems::route('/{record}/edit'),
        ];
    }
}
