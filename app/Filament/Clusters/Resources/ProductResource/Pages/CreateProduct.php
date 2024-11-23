<?php

namespace App\Filament\Clusters\Resources\ProductResource\Pages;

use App\Filament\Clusters\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
