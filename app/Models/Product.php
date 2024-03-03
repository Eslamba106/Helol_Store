<?php

namespace App\Models;

use Illuminate\Support\Str;
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

    public function tags(){
        return $this->belongsToMany(Tag::class , 'product_tag' , 'product_id' , 'tag_id' , 'id' , 'id');
    }

    public function scopeActive(Builder $builder){
        $builder->where('status' , 'active');
    }

    // accessors

    public function getImageUrlAttribute(){
        if(!$this->image){
            return "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D";
        }
        if(Str::startsWith($this->image, ['http://' , 'https://'])){
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }
    public function getSalePercentAttribute(){
        if(!$this->compare_price){
            return 0;
        }

        return number_format(100 - (100 * $this->price / $this->compare_price) , 0);
    
}

}
