<?php

namespace Database\Seeders;

use App\Models\ProductSubCategory;
use Illuminate\Database\Seeder;

class ProductSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductSubCategory::factory()->count(25)->create();
    }
}
