<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $name
 * @property string $sku
 * @property string $slug
 * @property string $description
 * @property ?double $price
 * @property ?integer $stock
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property DateTime $deleted_at
 */
class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'slug',
        'description',
        'price',
        'stock',
        'deleted_at'
    ];
}
