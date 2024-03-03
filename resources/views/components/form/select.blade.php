@props([
    'name' , 'options'  , 'selected'=> ''
])

<select 
name="{{ $name }}" 
{{-- class="form-control form-select" --}}
    {{ $attributes->class([
        'form-control',
        'form-select',
        'is-invalid' => $errors->has($name)
    ]) 
    }}

>
<option value=""></option>
@foreach ($options as $option_value => $option_text)
    <option value="{{ $option_value }}" @selected($option_value == old($name , $selected))>{{ $option_text }}</option>
@endforeach
</select> 
<x-form.error :name="$name" />








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