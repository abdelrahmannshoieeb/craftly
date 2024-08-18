<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource\RelationManagers\ProductAdditionRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\ProductColorRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\ProductSizeRelationManager;
use App\Models\Addition;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
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

                Section::make('Product Details')
                ->collapsible()
                ->icon("heroicon-o-sparkles")
                    ->schema([
                        Select::make('category_id')
                        ->placeholder('Category')
                           ->searchable()
                            ->relationship(name: 'category', titleAttribute: 'name')
                            ->options( \App\Models\Category::all()->pluck('name', 'id'))
                            ->required()
                            ->label('Category'),
                        TextInput::make('name')
                            ->placeholder('Name')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                        ->placeholder('Description')
                            ->maxLength(65535),
                        Textarea::make('detailes')
                        ->placeholder('Details')
                            ->maxLength(65535),
                       
                            TagsInput::make('tags')
                            ->separator(',')
                            ->required()
                            ->columnSpanFull()
                    ])
                    ->columns(2)
                    ->columnSpan(2),
                
                    Section::make('Numerice Details')
                    ->collapsible()
                    ->icon("heroicon-o-calculator")
                    
                        ->schema([
                            Forms\Components\TextInput::make('base_price')
                            ->placeholder('price')
                            ->label('price')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('stock')
                        ->placeholder('Stock')
                            ->required()
                            ->label('Stock')
                            ->numeric(),
                        Forms\Components\TextInput::make('discount_value')
                        ->placeholder('Discount')
                        ->label('Discount')
                            ->numeric(),
        
                        ])->columnSpan(1),
               
               

                    Section::make('Variations')
                    ->collapsible()
                    ->icon("heroicon-o-squares-2x2")
                        ->schema([
                            Repeater::make('colors')
                            ->label('Colors')
                            ->schema([
                                Select::make('color_id')
                                ->placeholder('color')
                                    ->label('Color')
                                    ->searchable()
                                    ->options(Color::all()->pluck('color', 'id')) 
                                    ->required()
                                    ->createOptionForm([
                                        TextInput::make('color'),
                                        // ColorPicker::make('Pick a color'),
                                        TextInput::make('hex code')
                                        ->prefix('#'),
                                        View::make('components.color-picker'),
                                    ])
                                    ->createOptionUsing(function (array $data) {
                                        $hex = $data['hex'];
                                        if (!str_starts_with($hex, '#')) {
                                            $hex = '#' . $hex;
                                        }
                                        $color = Color::create([
                                            'color' => $data['color'],
                                            'hex' => $hex,
                                        ]);
                                        return $color->id;
                                    }),
                                TextInput::make('price')
                                ->placeholder('price')
                                    ->label('Price')
                                    ->numeric()
                                    ->required(),
                                FileUpload::make('color_image')

                                ->label('color Image')
                                ->imageEditor(),
                            ])
                            ->columns(3)
                            ->collapsible(),
        
        
                        Repeater::make('sizes')
                            ->label('sizes')
                            ->schema([
                                Select::make('size_id')
                                ->placeholder('Size')
                                    ->label('size')
                                    ->options(Size::all()->pluck('size', 'id'))
                                    ->required()
                                    ->createOptionForm([
                                        TextInput::make('size'),
                                    ])
                                    ->createOptionUsing(function (array $data) {
                                      
                                        $size = Size::create([
                                            'size' => $data['size'],
                                        ]);
                                        return $size->id;
                                    }),
                                TextInput::make('price')
                                    ->label('Price')
                                    ->placeholder('Price')
                                    ->numeric()
                                    ->required(),
                                FileUpload::make('size_image')
                                ->label('color Image')
                                ->imageEditor(),
                            ])
                            ->columns(3)
                            ->collapsible(),
                        Repeater::make('additions')
                            ->label('additions')
                            ->schema([
                                Select::make('addition_id')
                                ->placeholder('Addition')
                                    ->label('addition')
                                    ->options(Addition::all()->pluck('addition', 'id'))
                                    ->required()
                                    ->createOptionForm([
                                        TextInput::make('Addition'),
                                    ])
                                    ->createOptionUsing(function (array $data) {
                                      
                                        $addition = Addition::create([
                                            'addition' => $data['addition'],
                                        ]);
                                        return $addition->id;
                                    }),
                                TextInput::make('price')
                                ->placeholder('Price')
                                    ->label('Price')
                                    ->numeric()
                                    ->required(),
                                FileUpload::make('addition_image')
                                
                                ->label('color Image')
                                ->imageEditor(),
                            ])
                          
                            ->columns(3)
                            ->collapsible(),
                        ])  ->columnSpan(2),

                       

                        Section::make('Images')
                        ->collapsible()
                        ->icon("heroicon-o-photo")
                            ->schema([
                                FileUpload::make('images')
                                ->label('Main Image')
                                ->imageEditor()
                                ->disk('public')
                                ->directory('product images'),
                                
                                FileUpload::make('gallery')
                                ->label('Gallery')
                                ->disk('public')
                                ->multiple()
                                ->imageEditor()
                                ->directory('products gallary'),
                              
                            ])->columns(1)
                            ->columnSpan(1),
              
                            
            ])->columns(3);

            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('description')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('detailes')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('base_price')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('discount_value')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('images') 
                ->label('Product Images')
                ->size(100)
                ->disk('public') ,
                
                ImageColumn::make('gallery')
                ->label('Product gallery')
                ->size(100),


            ])
            ->filters([])
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
            'images' => $data['images'],
            'gallery' => $data['gallery'],
            
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
        
            $colorImageWithQuotes = '"' . $color['color_image'] . '"';
        
            DB::table('product_colors')->insert([
                'product_id' => $product->id,
                'price' => $color['price'],
                'name' => $colorName,
                'color_image' => $colorImageWithQuotes, 
                'hex' => $hex,
            ]);
        }
        
        foreach ($data['additions'] as $addition) {
            $additionName = DB::table('additions')->where('id', $addition['addition_id'])->value('addition');
        
            $additionImageWithQuotes = '"' . $addition['addition_image'] . '"';
        
            DB::table('product_additions')->insert([
                'product_id' => $product->id,
                'price' => $addition['price'],
                'name' => $additionName,
                'addition_image' => $additionImageWithQuotes, 
            ]);
        }
        
        foreach ($data['sizes'] as $size) {
            $sizeName = DB::table('sizes')->where('id', $size['size_id'])->value('size');
        
            $sizeImageWithQuotes = '"' . $size['size_image'] . '"';
        
            DB::table('product_sizes')->insert([
                'product_id' => $product->id,
                'price' => $size['price'],
                'name' => $sizeName,
                'size_image' => $sizeImageWithQuotes, 
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
