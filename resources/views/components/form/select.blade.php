{{-- @props([
    'name' , 'value'=> '' , //'label'
]) --}}

<select 
name="{{ $name }}" 

class="form-control form-select"
{{-- {{ $attributes->class([
    'form-control',
    'form-select',
    // 'is-invalid' => $errors->has($name)
]) }} --}}

{{-- {{ $attributes->class([
    'form-control',
    'is-invalid' => $errors->has($name),
]) }} --}}
>
@foreach ($options as $value => $text)
    <option value="{{ $value }}" @selected($value == $selected)>{{ $text }}</option>
@endforeach
</select>
{{-- <x-form.validation-feedback :name="$name" /> --}}
@error($name)
<div class="invalid-feedback">
   {{ $message }}
</div>
@enderror







{{-- @props([
    'name' , 'primary_value' ,'options' , 'select'=>false
])
<select name="{{ $name }}" class="form-control form-select">
    <option value="">{{ $primary_value }}</option>
    @foreach ($options as $value => $text)
        <option value="{{ $value }}"
        @selected(old($name, $checked) == $value)>
        {{ $text }} --}}
        {{-- @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }} --}}
    {{-- </option>
    @endforeach
</select> --}}