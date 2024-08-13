<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource\RelationManagers\ProductColorRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\ProductSizeRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\ProductAdditionRelationManager;
use App\Models\Addition;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select; 
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource; 
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                ->searchable()
                    // ->multiple() 
                    ->relationship(name: 'category' , titleAttribute: 'name')
                    ->options(
                        \App\Models\Category::all()->pluck('name', 'id')
                    
                    )
                    ->required()
                    ->label('Category'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('detailes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('base_price')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('stock')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('discount_value')
                    ->numeric(),

                Repeater::make('colors')
                ->label('Colors')
                ->schema([
                    Select::make('color_id')
                        ->label('Color')
                        ->options(Color::all()->pluck('color', 'id')) // Assuming a Color model
                        ->required(),
                    TextInput::make('price')
                        ->label('Price')
                        ->numeric()
                        ->required(),
                ])
                ->columns(2)
                ->collapsible(),

                
                Repeater::make('sizes')
                ->label('sizes')
                ->schema([
                    Select::make('size_id')
                        ->label('size')
                        ->options(Size::all()->pluck('size', 'id')) 
                        ->required(),
                    TextInput::make('price')
                        ->label('Price')
                        ->numeric()
                        ->required(),
                ])
                ->columns(2)
                ->collapsible(),

                Repeater::make('additions')
                ->label('additions')
                ->schema([
                    Select::make('addition_id')
                        ->label('addition')
                        ->options(Addition::all()->pluck('addition', 'id')) 
                        ->required(),
                    TextInput::make('price')
                        ->label('Price')
                        ->numeric()
                        ->required(),
                ])
                ->columns(2)
                ->collapsible(),
            ]);
          
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('detailes')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('base_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_value')
                    ->numeric()
                    ->sortable(),

               
            ])
            ->filters([
                
            ])
            ->actions([
                ActionGroup::make([
                   Tables\Actions\ViewAction::make()
                   ->slideOver(),
                   Tables\Actions\EditAction::make(),
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
            ProductColorRelationManager::class,
            ProductAdditionRelationManager::class,
            ProductSizeRelationManager::class,
        ];
        }
    public static function changeSaver(array $data): array
    {
        $productData = [

            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'detailes' => $data['detailes'],
            'base_price' => $data['base_price'],
            'stock' => $data['stock'],
            'quantity' => $data['quantity'],
            'discount_value' => $data['discount_value'] ?? null,
        ];

        $colorData = $data['colors'] ?? [];
        $sizeData = $data['sizes'] ?? [];
        $additionData = $data['additions'] ?? [];

        return [
            'product' => $productData,
            'colors' => $colorData,
            'sizes' => $sizeData,
            'additions' => $additionData,
        ];
    }
    public static function saveData(array $data): Product
    {
        $product = Product::create($data['product']);
    
        foreach ($data['colors'] as $color) {
            $colorName = DB::table('colors')->where('id', $color['color_id'])->value('color');
            $hex = DB::table('colors')->where('id', $color['color_id'])->value('hex');
            
            DB::table('product_colors')->insert([
                'product_id' => $product->id,
                'price' => $color['price'],
                'color' => $colorName,
                'hex' => $hex,
            ]);
        }
    
        foreach ($data['sizes'] as $size) {
            $sizeName = DB::table('sizes')->where('id', $size['size_id'])->value('size');
            
            DB::table('product_sizes')->insert([
                'product_id' => $product->id,
                'price' => $size['price'],
                'size' => $sizeName,
            ]);
        }
    
        foreach ($data['additions'] as $addition) {
            $additionName = DB::table('additions')->where('id', $addition['addition_id'])->value('addition');
            
            DB::table('product_additions')->insert([
                'product_id' => $product->id,
                'price' => $addition['price'],
                'addition' => $additionName,
            ]);
        }
        
        return $product;
    }
    


    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
