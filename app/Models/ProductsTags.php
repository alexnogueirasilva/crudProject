<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $product_id
 * @property mixed $tag_id
 * @method static create(array $all)
 */
class ProductsTags extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'tag_id'
    ];

}
