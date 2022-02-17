<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $product_id
 * @property mixed $tag_id
 */
class ProductsTags extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'tag_id'
    ];

}
