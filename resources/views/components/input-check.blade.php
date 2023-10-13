@php
    $number = (string) rand(100,999);
    $title = $options['title'] ?? '' ;
    $name = $options['name'] ?? 'name-'.$number;
    $switch = $options['switch'] ?? '';
    $checked = $options['checked'] ?? '';
    $disabled = $options['disabled'] ?? '';
@endphp
<div class="form-check {{ $switch ? 'form-switch':'' }}">
    <input class="form-check-input" type="checkbox"  id="{{ $name }}" name="{{ $name }}" {{ $checked?'checked':'' }} {{ $disabled?'disabled':'' }}   />
    <label class="form-check-label" for="{{ $name }}">
        {{ $title }}
    </label>
</div>