<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Observers\CartObserve;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    public $incrementing = false ;
    protected $fillable = ['id', 'cookie_id', 'user_id', 'product_id', 'quantity', 'options' , 'offer'];

    public static function booted()
    {
        static::observe(CartObserve::class);
        // static::creating(function (Cart $cart) {
        //     $cart->id = Str::uuid();
        // });
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            'name'=> 'Anonymous',
        ]);
    }
    public function product(){
        return $this->belongsTo(Product::class); 
    }
}