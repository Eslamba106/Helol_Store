<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Observers\CartObserve;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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
        static::addGlobalScope('cookie_id' , function(Builder $builder){
            $builder->where('cookie_id' , self::getCookie_id());
        });
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            'name'=> 'Anonymous',
        ]);
    }
    public function product(){
        return $this->belongsTo(Product::class); 
    }
    
    public static function getCookie_id(){
        $cookie_id = Cookie::get('cart_id');
        if(!$cookie_id){
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id' , $cookie_id , 30*24*60*60);
            // Cookie::queue('cart_id' , $cookie_id , Carbon::now()->addDays(30));
        }
        return $cookie_id ;
    }
}