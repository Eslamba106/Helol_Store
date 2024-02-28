<div class="form-group">
    <x-form.label id="name">Category Name</x-form.label>
    <x-form.input type="text" name="name" class="form-control-lg" :value="$category->name" /> {{--  label="Category Name" --}}
</div>

<div class="form-group">
    <x-form.label id="parent_id">Category Parent</x-form.label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>
    {{-- <x-form.select name="parent_id" primary_value="Primary Category" 
    :options="[]"
    /> --}}
</div>

<div class="form-group">
    <x-form.label id="description">Category Description</x-form.label>
    <x-form.textarea name="description" :value="$category->description" /> {{-- label="Category Description" --}}
</div>

<div class="form-group">
    <x-form.label id="image">Category Image</x-form.label>
    <x-form.input type="file" name="image" accept="image/*" /> {{--  label="Category Image" --}}

    @if ($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" height="60" alt="">
    @endif
</div>

<div class="form-group">
    <x-form.radio name="status" :checked="$category->status" :options="['active' => 'Active', 'archived' => 'Archived']" />
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>
{{-- @if ($errors->any())
<div class="alert alert-danger">
    <h3>Error Occured!</h3>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach    
    </ul>    
</div>    
@endif --}}
{{-- <input type="text" name="name" @class(['form-control', 'is-invalid' => $errors->has('name')])
     value="{{ old('name', $category->name )}}"> --}}
{{-- class="form-control @error('name') is-invalid @enderror" --}}
{{-- @error('name')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror --}}
{{-- @if ($errors->has('name'))
        <div class="text-danger">
            {{ $errors->first('name') }}
        </div>
    @endif --}}

{{-- <div class="form-group">
        <lable for="">Category Description</lable>
        <textarea type="text" name="description" class="form-control" value="{{ old('description', $category->description ) }}"></textarea>
    </div> --}}
{{-- 
    <lable for="">Category Image</lable>
    <input type="file" name="image" class="form-control" accept="image/*"> --}}

{{-- <lable for="">Category Parent</lable> --}}

{{-- <lable for="">Category Status</lable>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="active" @checked(old('status', $category->status) == 'active')>
            <label class="form-check-label">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="archived" @checked(old('status', $category->status) == 'archived')>
            <label class="form-check-label">
                Archived
            </label>
        </div>
    </div> --}}

{{-- <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select> --}}
