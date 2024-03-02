<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'birthday', 'gender', 'streer_address', 'city', 'state', 'postal_code', 'country', 'locale', 'created_at', 'updated_at'
    ] ;
    protected $table  = "profiles";
    protected $primaryKey = "user_id";
    public function user(){
        return $this->belongsTo(User::class , 'user_id' , 'id') ;
    }
}
