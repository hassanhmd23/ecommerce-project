<?php

namespace App\Observers;

use App\Models\ProductCategory;
use App\Models\ProductSubCategory;

class ProductCategoryObserver
{
    /**
     * Handle the ProductCategory "created" event.
     */
    public function created(ProductCategory $productCategory): void
    {
        //
    }

    /**
     * Handle the ProductCategory "updated" event.
     */
    public function updated(ProductCategory $productCategory): void
    {
        //
    }

    /**
     * Handle the ProductCategory "deleted" event.
     */
    public function deleted(ProductCategory $productCategory): void
    {
        foreach ($productCategory->subCategories as $subCategory) {
            $subCategory->delete();
        }
    }

    /**
     * Handle the ProductCategory "restored" event.
     */
    public function restored(ProductCategory $productCategory): void
    {
        /* @var $subCategory ProductSubCategory */
        foreach ($productCategory->subCategories()->onlyTrashed()->get() as $subCategory) {
            $subCategory->restore();
        }
    }

    /**
     * Handle the ProductCategory "force deleted" event.
     */
    public function forceDeleted(ProductCategory $productCategory): void
    {
        //
    }
}
