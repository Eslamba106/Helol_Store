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
<div class="form-group">
    <lable for="">Category Name</lable>
    <input type="text" name="name" class="form-control" value="{{ $category->name }}">
    @error('name')
    <div class="text-danger">
        {{ $message }}
    </div>
    @enderror
    {{-- @if ($errors->has('name'))
        <div class="text-danger">
            {{ $errors->first('name') }}
        </div>
    @endif --}}
</div>
<div class="form-group">
    <lable for="">Category Parent</lable>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected($category->parent_id == $parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <lable for="">Category Description</lable>
    <textarea type="text" name="description" class="form-control" value="{{ $category->description }}"></textarea>
</div>
<div class="form-group">
    <lable for="">Category Image</lable>
    <input type="file" name="image" class="form-control" accept="image/*">
    @if ($category->image)
    <img src="{{ asset('storage/' . $category->image) }}" height="60" alt="">
    @endif
</div>
<div class="form-group">
    <lable for="">Category Status</lable>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="active" checked>
            <label class="form-check-label">
              Active
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="archived" >
            <label class="form-check-label">
              Archived
            </label>
          </div>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save'}}</button>
</div>