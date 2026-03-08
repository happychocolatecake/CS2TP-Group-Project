<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReturnOrder extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['return_date', 'reason', 'return_status', 'return_quantity',
    'product_id', 'order_id', 'user_id', 'stock_restored'];

    protected $casts = [
        'return_date' =>'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
