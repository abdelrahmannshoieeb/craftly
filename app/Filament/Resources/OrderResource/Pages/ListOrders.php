<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Tables\Filters\Filter;
use Illuminate\Support\Facades\DB;



class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

 
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All')
            ->icon('heroicon-s-table-cells'),

            'total_paid' => Tab::make('total_paid')
            ->icon('heroicon-s-check-circle') 
            ->modifyQueryUsing(fn ($query) => $query->where('total_status', 'paid')),

            'total_unpaid' => Tab::make('total_unpaid')
            ->icon('heroicon-s-x-mark') 
            ->modifyQueryUsing(fn ($query) => $query->where('total_status', 'partial_paid')),

            'deposit_paid' => Tab::make('deposit_paid')
            ->icon('heroicon-s-check-circle') 
            ->modifyQueryUsing(fn ($query) => $query->where('deposit_status', 'paid')),

            'deposit_unpaid' => Tab::make('deposit_unpaid')
            ->icon('heroicon-s-x-mark') 
            ->modifyQueryUsing(fn ($query) => $query->where('deposit_status', 'notpaid')),


            'deliverd' => Tab::make('deliverd')
            ->icon('heroicon-s-truck') 
            ->modifyQueryUsing(fn ($query) => $query->where('order_status', 'deliverd')),

            'sent' => Tab::make('sent')
            ->icon('heroicon-s-paper-airplane') 
            ->modifyQueryUsing(fn ($query) => $query->where('order_status', 'sent')),


            'checked' => Tab::make('checked')
            ->icon('heroicon-s-eye') 
            ->modifyQueryUsing(fn ($query) => $query->where('order_status', 'checked')),


            'inproccesing' => Tab::make('inproccesing')
            ->icon('heroicon-s-cog') 
            ->modifyQueryUsing(fn ($query) => $query->where('order_status', 'inproccesing')),


            'refused' => Tab::make('refused')
            ->icon('heroicon-s-hand-thumb-down') 
            ->modifyQueryUsing(fn ($query) => $query->where('order_status', 'refused')),


            'done' => Tab::make('done')
            ->icon('heroicon-s-building-storefront') 
            ->modifyQueryUsing(fn ($query) => $query->where('order_status', 'done')),


          
            
        ];
    }


}
