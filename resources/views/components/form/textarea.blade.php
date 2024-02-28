@props([
    'name' , 'value'=>'' , //'label'
])
{{-- @if(isset($label))
<lable for="">{{ $label }}</lable>
@endif --}}

<textarea 
name="{{ $name }}" 
{{ $attributes->class([
    'form-control',
    'is-invalid' => $errors->has($name),
]) }}
>{{ old($name, $value )}}</textarea>

@error($name)
<div class="invalid-feedback">
   {{ $message }}
</div>
@enderror



{{-- @class(['form-control', --}}
{{-- 'is-invalid' => $errors->has($name)]) --}}
 {{-- class="form-control @error('name') is-invalid @enderror" --}}