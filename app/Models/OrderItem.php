<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItem extends Pivot
{
    use HasFactory;

    protected $table = 'order_items';
    // protected $primaryKey = 'id';

    public $incrementing = true;
    public $timestmps = false;
    protected $fillable = [
        'order_id', 'product_id', 'product_name', 'price', 'quantity', 'options', 'created_at', 'updated_at'
    ];

    public function product(){
        return $this->belongsTo(Product::class)->withDefault([
            'name' => $this->product_name
        ]);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }

}
