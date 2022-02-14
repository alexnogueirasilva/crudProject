<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $product_id
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
}
