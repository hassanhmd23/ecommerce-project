<?php

namespace App\Models;

use App\Observers\ProductCategoryObserver;
use Database\Factories\ProductCategoryFactory;
use DateTime;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property ?string $description
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property DateTime $deleted_at
 * @property ProductSubCategory[] $subCategories
 */
#[ObservedBy(ProductCategoryObserver::class)]
class ProductCategory extends Model
{
    /** @use HasFactory<ProductCategoryFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'deleted_at',
    ];

    public function subCategories(): HasMany
    {
        return $this->hasMany(ProductSubCategory::class, 'parent_id', 'id');
    }
}
