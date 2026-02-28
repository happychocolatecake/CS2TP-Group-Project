<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable  = ['order_address',
    'total_price', 'delivery_method','order_date', 'order_status',
    'user_id'];

    protected $casts = [
        'order_date' =>'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }

}
