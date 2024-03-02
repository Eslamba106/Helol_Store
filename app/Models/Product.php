<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'store_id', 'category_id', 'name', 'slug', 'discription', 'image', 'price', 'compare_price', 'options', 'rating', 'featured', 'status', 'deleted_at', 'created_at', 'updated_at'
    ];
    protected $table = "products";

    protected static function booted()
    {
        static::addGlobalScope('store' ,new StoreScope());
        // static::addGlobalScope('store' , function(Builder $builder){
        //     $user = Auth::user();
        //     if($user->store_id){
        //         $builder->where('store_id' , $user->store_id);
        //     }
        // });
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id' , 'id');
    }
    
    public function store(){
        return $this->belongsTo(Category::class,'store_id' , 'id');
    }
}
