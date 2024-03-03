<div class="form-group">
    <x-form.label id="name">Product Name</x-form.label>
    <x-form.input type="text" name="name" class="form-control-lg" :value="$product->name" /> {{--  label="Product Name" --}}
</div>

<div class="form-group">
    <x-form.label id="parent_id">Category</x-form.label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach (App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" @selected(old('parent_id', $category->parent_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
    {{-- <x-form.select name="parent_id" primary_value="Primary Product" 
    :options="[]"
    /> --}}
</div>

<div class="form-group">
    <x-form.label id="description">Product Description</x-form.label>
    <x-form.textarea name="description" :value="$product->description" /> {{-- label="Product Description" --}}
</div>

<div class="form-group">
    <x-form.label id="image">Product Image</x-form.label>
    {{-- <label for="">Product Image</label> --}}
    <x-form.input type="file" name="image" accept="image/*" /> {{--  label="Product Image" --}}

    @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" height="60" alt="">
    @endif
</div>
<div class="form-group">
    <x-form.label id="name">Price</x-form.label>
    <x-form.input type="text" name="price" class="form-control-lg" :value="$product->price" /> {{--  label="Product Name" --}}
</div>
<div class="form-group">
    <x-form.label id="name">Compare Price</x-form.label>
    <x-form.input type="text" name="compare_price" class="form-control-lg" :value="$product->compare_price" /> {{--  label="Product Name" --}}
</div>
<div class="form-group">
    <x-form.label id="name">Tags</x-form.label>
    <x-form.input type="text" name="tags" class="form-control-lg" :value="$tags" /> {{--  label="Product Name" --}}
</div>
<div class="form-group">
    <x-form.label id="name">Status</x-form.label>
    <x-form.radio name="status" :checked="$product->status" :options="['active' => 'Active', 'archived' => 'Archived' , 'draft'=> 'Draft']" />
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>

@push('styles')
<link href="{{ asset('dist/css/tagify.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
<script src="{{ asset('dist/js/tagify.js') }}"></script>
<script src="{{ asset('dist/js/tagify.polyfills.min.js') }}"></script>
<script>
    var inputElm = document.querySelector('[name=tags]');
    tagify = new Tagify (inputElm);
</script>
@endpush
