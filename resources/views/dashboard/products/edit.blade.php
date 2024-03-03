@extends('layouts.dashboard')

@section('title', 'Edit Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
    <li class="breadcrumb-item active">Edit Product</li>
@endsection
@section('content')
    <form action="{{ route('dashboard.products.update' , $product->id) }}" method="post" >
        @csrf
        @method('put')
        @include('dashboard.products._form' , [
            'button_label' => 'Update'
        ])

    </form>
@endsection