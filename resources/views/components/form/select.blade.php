@props([
    'name' , 'primary_value' ,'options' , 'select'=>false
])
<select name="{{ $name }}" class="form-control form-select">
    <option value="">{{ $primary_value }}</option>
    @foreach ($options as $value => $text)
        <option value="{{ $value }}"
        @selected(old($name, $checked) == $value)>
        {{ $text }}
        {{-- @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }} --}}
    </option>
    @endforeach
</select>