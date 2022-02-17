<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static products()
 * @method static paginate(int $int)
 */
class Product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'tag_id'
    ];

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'products_tags', 'product_id', 'tag_id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeProducts($query): mixed
    {
        return $query->with('tags')
            ->join('products_tags', 'products.id', '=', 'products_tags.product_id')
            ->join('tags', 'products_tags.tag_id', '=', 'tags.id')
            ->select('products.*', 'products_tags.*', 'tags.name AS tag_name')
            ->get();

    }

}
