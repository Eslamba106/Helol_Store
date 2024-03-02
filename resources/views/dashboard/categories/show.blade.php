@extends('layouts.dashboard')

@section('title', $category->name)

@section('breadcrumb')
    @parent
    {{-- <li class="breadcrumb-item active">Categories</li> --}}
    <li class="breadcrumb-item active">{{  $category->name  }}</li>
@endsection
@section('content')
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        {{-- @if ($products->count()) --}}
        @forelse ($category->products()->with('store')->paginate() as $product)
            <tr>
                <td><img src="{{ asset('storage/' . $product->image) }}" height="50" alt=""></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->store->name}}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->created_at }}</td>
                {{-- <td>
                    <a href="{{ route('dashboard.products.edit', $product->id) }}"
                        class="btn btn-sm btn-outline-success">Edit</a>
                </td> --}}
                {{-- <td>
                    <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post">
                        @csrf
                        Form Method Spoofing
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td> --}}
            </tr>
        @empty
            <tr>
                <td colspan="5">No products Defined.</td>
            </tr>
        @endforelse
        {{-- @else

        @endif --}}
    </tbody>
</table>
@endsection