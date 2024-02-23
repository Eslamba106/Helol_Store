<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'categories';
    protected $fillable = [ 'parent_id', 'name', 'slug', 'description', 'image', 'status', 'created_at', 'updated_at'] ;
    protected $guarded = ['id'];
}
