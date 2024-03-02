@extends('layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">products</li>
@endsection
@section('content')
    <div class="mb-5">
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-sm btn-outline-primary">Create</a>
    </div>
<x-alert type="success"/>
<x-alert type="info"/>
<x-alert type="fail"/>
<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
    <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')"/>
    <select name="status" class="form-control mx-2">
        <option value="">All</option>
        <option value="active" @selected(request('status') == 'active')>Active</option>
        <option value="archived" @selected(request('status') == 'archived')>Archived</option>
    </select>
    <button class="btn btn-dark mx-2">Filter</button>
</form>
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Store</th>
                <th>Status</th>
                <th>Created At</th>
                <th colspan="2">Operation</th>
            </tr>
        </thead>
        <tbody>
            {{-- @if ($products->count()) --}}
            @forelse ($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/' . $product->image) }}" height="50" alt=""></td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td>{{ $product->store_id}}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.products.edit', $product->id) }}"
                            class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post">
                            @csrf
                            {{-- Form Method Spoofing --}}
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No products Defined.</td>
                </tr>
            @endforelse
            {{-- @else

            @endif --}}
        </tbody>
    </table>
    {{ $products->withQueryString()->appends(['search' => 1])->links() }}
@endsection
