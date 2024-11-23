<?php

namespace App\Models;

use Database\Factories\ProductSubCategoryFactory;
use DateTime;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $slug
 * @property ?string $description
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property DateTime $deleted_at
 * @property ProductCategory $parentCategory
 */
class ProductSubCategory extends Model
{
    /** @use HasFactory<ProductSubCategoryFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'deleted_at',
    ];

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id', 'id');
    }
}
