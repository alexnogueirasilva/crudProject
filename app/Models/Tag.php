<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $product_id
 * @method static where(string $string, $id)
 * @method static findOrFail($id)
 * @method static find($id)
 * @method static create(array $all)
 */

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    /**
     * @return BelongsToMany
     */
    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_tags', 'product_id', 'tag_id');
    }

    public function scopeTagRelationship($query)
    {
        return $query->with('product')
            ->join('products_tags', 'tags.id', '=', 'products_tags.tag_id')
            ->join('products', 'products_tags.product_id', '=', 'products.id')
            ->select('tags.name', 'products.name AS product_name')
            ->get();
    }
}
