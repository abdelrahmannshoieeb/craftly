<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RefundResource\Pages;
use App\Filament\Resources\RefundResource\RelationManagers;
use App\Infolists\Components\OrderAndCartItems;
use App\Models\Refund;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RefundResource extends Resource
{
    protected static ?string $model = Refund::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Refunds')
                    ->collapsible()
                    ->icon("heroicon-o-squares-2x2")
                        ->schema([
                            TextInput::make('customer_reason')
                            ->label('Customer Reason')
                            ->required()
                            ->placeholder('Customer Reason'),

                            Toggle::make('acceptance_status')
                            ->label('Accept or refuse'),

                            Select::make('order_id')
                            ->placeholder('Order')
                            ->searchable()
                            ->relationship(name: 'order', titleAttribute: 'id')
                            ->options( \App\Models\Order::all()->pluck('id', 'id'))
                            ->required() 
                            ->label('Order'),
                        ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_reason'),
                BooleanColumn::make('acceptance_status'),
                TextColumn::make('order_id'),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('viewItems')
                ->label('View items')
                ->url(fn ($record) => "http://127.0.0.1:8000/admin/orders/{$record->order_id}")
                ->icon('heroicon-o-eye')
                ->color('red')
                ->openUrlInNewTab(),
             

                Action::make('viewOrder')
                ->label('View Order')
                ->url( "http://127.0.0.1:8000/admin/orders")
                ->icon('heroicon-o-eye')
                ->color('red')
                ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRefunds::route('/'),
            'create' => Pages\CreateRefund::route('/create'),
            'edit' => Pages\EditRefund::route('/{record}/edit'),
        ];
    }
}
