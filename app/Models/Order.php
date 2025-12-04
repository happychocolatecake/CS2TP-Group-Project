<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // If your table name isn't 'orders', define it here:
    // protected $table = 'your_orders_table';
    
    // Add fillable fields if you plan to save data
    // protected $fillable = ['user_id', 'status', 'total'];
}