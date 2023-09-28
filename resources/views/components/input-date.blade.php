@php    
    // https://flatpickr.js.org/examples/
     $number = (string) rand(10,99);
     $name = $options['name'] ?? 'name_'.$number;
     $id =   $options['id'] ?? $name;
     $title= $options['title'] ?? '' ;
     $placeholder = $options['placeholder'] ?? $title ;     
     $value = $options['value'] ?? '';     
     $format = $options['format'] ?? "d/m/Y";
 
@endphp
<div class="row mb-3">    
    @if ($title !=='')
        <label class="col-md-4 col-form-label text-md-end" for="{{ $name }}">{{ __($title) }}</label>        
    @endif
    <input type="text" name="{{ $name }}" id="{{ $id }}" class="form-control flatpickr flatpickr-input" placeholder="{{ $placeholder  ?? 'Select Date' }}" readonly="readonly" />
</div>
@section('jsFooter') 
@parent
<script>
    $('.flatpickr-input').flatpickr({        
        dateFormat: "{{$format}}",
    });
</script>
@endsection