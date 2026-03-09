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

    public function returns()
    {
        return $this->hasMany(ReturnOrder::class);
    }

    public function isReturnable(): bool
    {
        //makes sure the order this return request belongs to is delivered
        $validStatus = [
        'Delivered',
        'Shipped',
        'Partially Returned',
        'Pending Partial Return',
        'Pending Full Return'
        ];

        return in_array($this->order_status, $validStatus);
    }

    public function isCancellable(): bool
    {
    //make sure the order this return request belonds to is not shipped
    return $this->order_status === 'Placed';
    }

    public function getColourStatus()
    {
        return match($this->order_status) {
            'Delivered' => 'bg-green-500 text-white',
            'Shipped' => 'bg-blue-500 text-white',
            'Pending Full Return' => 'bg-yellow-500 text-white',
            'Pending Partial Return' => 'bg-orange-400 text-white',
            'Partially Returned' => 'bg-red-400 text-white',
            'Fully Returned' => 'bg-red-600 text-white',
            'Cancelled' => 'bg-gray-500 text-white',
            default => 'bg-indigo-600 text-white',
        };
    }

}
