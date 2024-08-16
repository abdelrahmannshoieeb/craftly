<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductColorRelationManager extends RelationManager
{
    protected static string $relationship = 'productColor';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('color')
                    ->required()
                    ->maxLength(255),
                    
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('color')
            ->columns([
                Tables\Columns\TextColumn::make('color'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\ImageColumn::make('color_image'),
                Tables\Columns\TextColumn::make('hex')
                ->label('Color')
                ->formatStateUsing(function ($record) {
                    $hexCode = $record->hex; 
                    return "<span style='display: inline-block; width: 24px; height: 24px; border-radius: 50%; background-color: {$hexCode};'></span>";
                })
                ->html(),


            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
