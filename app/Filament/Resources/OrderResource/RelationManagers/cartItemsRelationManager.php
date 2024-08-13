<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CartItemRelationManager extends RelationManager
{
    protected static string $relationship = 'cartItem';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),

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
                TextColumn::make('color_price')
                ->label('Color Price'),


                TextColumn::make('size')
                ->label('Size')
                ->formatStateUsing(function ($state) {
                    if ($state) {
                        $sizeName = DB::table('sizes')->where('id', $state)->value('size');
                        return $sizeName ?: 'Size not found';
                    }
                    return 'No size selected';
                }),
                TextColumn::make('size_price')
                ->label('Size Price'),


                TextColumn::make('addition')
                ->label('addition')
                ->formatStateUsing(function ($state) {
                    if ($state) {
                        $addition = DB::table('additions')->where('id', $state)->value('addition');
                        return $addition ?: 'Size not found';
                    }
                    return 'No size selected';
                }),
                TextColumn::make('addition_price')
                ->label('Addition Price'),


                Tables\Columns\TextColumn::make('product.name')
                ->label('Product Name'),
            Tables\Columns\TextColumn::make('product.description')
                ->label('Product Description')
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('product.detailes')
                ->label('Product Details')
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('product.base_price')
                ->label('Base Price')
                ->formatStateUsing(fn ($state) => number_format($state, 2)),
            Tables\Columns\TextColumn::make('product.stock')
                ->label('Stock')
                ->formatStateUsing(fn ($state) => number_format($state, 2)),
            Tables\Columns\TextColumn::make('product.discount_value')
                ->label('Discount Value')
                ->formatStateUsing(fn ($state) => $state ? number_format($state, 2) : 'N/A'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
