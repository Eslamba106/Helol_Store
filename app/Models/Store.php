<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Store extends Model
{
    use HasFactory , Notifiable;
    // const CREATED_AT = 'created_at';
    // const UPDATED_AT = 'updated_at';
    // protected $connection = 'mysql';
    // protected $primaryKey = 'id';
    // protected $keyType = 'int';
    // public $incrementing = true ;
    // public $timestamps = true;
    protected $table = 'stores';
    protected $fillable = [ 'name', 'slug', 'description', 'logo_image', 'cover_image', 'status', 'created_at', 'updated_at'] ;

    public function products(){
        return $this->hasMany(Product::class , 'store_id' , 'id');
    }

}

