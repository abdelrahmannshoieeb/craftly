<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;



class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return ProductResource::changeSaver($data);
    }

    
    protected function handleRecordCreation(array $data): Model
    {
        return ProductResource::saveData($data);
    }
}



class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeUpdate(array $data): array
    {
        return ProductResource::changeSaver($data);
    }

    // protected function handleRecordUpdate(array $data): Model
    // {
    //     ProductResource::saveData($data);
    //     return Product::find($data['product']['id']); 
    // }
}