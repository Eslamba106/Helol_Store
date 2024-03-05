<?php 

namespace App\Repositories\Cart;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{
    public function get() :Collection ;

    public function add(Product $product , $quantity=1);

    public function update($id , $quantity = 1);
    
    public function delete($id);

    public function empty();

    public function total() ;
}