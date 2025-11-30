<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    
    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'product_stock',
        'category_id',
        'product_image'
    ];
}
