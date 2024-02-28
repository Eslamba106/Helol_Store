@if (session()->has($type))
<div class="alert alert-{{ $type }}">
    {{ session($type) }}
</div>
@endif
{{-- @if (session()->has('fail'))
<div class="alert alert-danger">
    {{ session('fail') }}
</div>
@endif
@if (session()->has('info'))
<div class="alert alert-info">
    {{ session('info') }}
</div>
@endif --}}