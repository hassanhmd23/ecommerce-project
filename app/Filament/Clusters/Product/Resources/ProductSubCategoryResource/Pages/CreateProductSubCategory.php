<?php

namespace App\Filament\Clusters\Product\Resources\ProductSubCategoryResource\Pages;

use App\Filament\Clusters\Product\Resources\ProductSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProductSubCategory extends CreateRecord
{
    protected static string $resource = ProductSubCategoryResource::class;
}
