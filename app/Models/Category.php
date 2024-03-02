<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'categories';
    protected $fillable = [ 'parent_id', 'name', 'slug', 'description', 'image', 'status', 'created_at', 'updated_at'] ;
    protected $guarded = ['id'];
    
    public function scopeFilter(Builder $builder , $filters){

        $builder->when($filters['name'] ?? false , function($builder , $value){
            $builder->where('categories.name','like','%'.$value.'%');
        });

        $builder->when($filters['status'] ?? false , function($builder , $value){
            $builder->where('categories.status', $value);
        });
        // if($filters['name'] ?? false){
        //     $builder->where('name','like','%'.$filters['name'].'%');
        // };
        // if($filters['status'] ?? false){
        //     $builder->where('status','=',$filters['status']);
        // };
    }
    // public function scopeActive(Builder $builder){
    //     $builder->where('status' , 'active');
    // }
    // public function scopeStatus(Builder $builder , $status){
    //     $builder->where('status' , $status);
    // }
    
    public static function rules($id = 0){
        return [
            'name'=> [
                'required',
                'string',
                'max:255',
                'min:3',
                'filter:php,laravel,react',
                Rule::unique('categories' , 'name')->ignore($id),
                // function($attribute , $value , $fails){
                //     if(strtolower($value) == 'laravel'){
                //         $fails('This name is forbidden');
                //     }
                // }    
            ],
            'parent_id' => [
                'nullable' , 'integer' , 'exists:categories,id'
            ],
            'image' => 'image|max:1028576|dimensions:min_width=100,min_height=100',
            'status' => 'in:active,archived',
        ];
    }

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function parent (){
        return $this->belongsTo(self::class,'parent_id','id')->withDefault([
            "name" => "Main Category"
        ]);
    }

    public function children (){
        return $this->hasMany(self::class , 'parent_id' , 'id');
    }
}
