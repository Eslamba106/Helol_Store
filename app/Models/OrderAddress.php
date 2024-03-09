<?php

namespace App\Models;

use Symfony\Component\Intl\Countries;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderAddress extends Model
{
    use HasFactory;

    public $table = 'order_addresses';
    public $timestamps = false;

    protected $fillable = [
        'order_id', 'type', 'first_name', 'last_name', 'email', 'phone_number', 'street_address', 'city', 'postal_code', 'state', 'country'
    ];

    public function getNameAttribute(){
        return $this->first_name . ' ' .$this->last_name;
    }
    public function getCountryNameAttribute(){
        return Countries::getName($this->country);
    }
}
