<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Product extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function getNavigationBadge(): ?string
    {
        return \App\Models\Product::query()->count();
    }
}
