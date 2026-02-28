<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $timestamps = false;

    protected $fillable  = ['rating',
    'review_image', 'review_text', 'review_date',
    'user_id', 'order_id', 'product_id', 'created_at'];

    protected $casts = [
        'created_at' => 'datetime' ];
    //this is for the foreign keys (many to one)

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function order() {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
