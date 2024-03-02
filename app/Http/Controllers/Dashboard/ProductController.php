<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::with(['category' , 'store'])->paginate();
        $products = Product::select(
            'products.*',
            'stores.name as store_name',
            'categories.name as category_name'
        )
        ->leftJoin('categories' , 'categories.id' , 'products.category_id')
        ->leftJoin('stores' , 'stores.id' , 'products.store_id')
        ->paginate();
        return view('dashboard.products.index' , compact('products'));

        // $user = Auth::user();
        // $products = Product::with(['category' , 'store'])->paginate();
        // if($user->store_id){

            // $products = Product::where('store_id' , $user->store_id)->paginate();
        // }else{
            // $products = Product::paginate();
        // }
        // if($user->store_id == null){
        //     $products = Product::withoutGlobalScope('store')->paginate();
        // }else{
        //     $products = Product::paginate();
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
