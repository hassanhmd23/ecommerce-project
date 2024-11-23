<?php

namespace App\Models;

use Database\Factories\ProductCategoryFactory;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property ?string $description
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property DateTime $deleted_at
 */
class ProductCategory extends Model
{
    /** @use HasFactory<ProductCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'deleted_at',
    ];

    public function SubCategory(): HasMany
    {
        return $this->hasMany(ProductCategoryFactory::class);
    }
}
