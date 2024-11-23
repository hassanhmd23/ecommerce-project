<?php

namespace App\Filament\Clusters\Product\Resources\ProductSubCategoryResource\Pages;

use App\Filament\Clusters\Product\Resources\ProductSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductSubCategory extends EditRecord
{
    protected static string $resource = ProductSubCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
