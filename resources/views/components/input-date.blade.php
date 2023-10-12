@php    
    // https://flatpickr.js.org/examples/
     $number = (string) rand(10,99);
     $name = $options['name'] ?? 'name_'.$number;
     $id =   $options['id'] ?? $name;
     $title= $options['title'] ?? '' ;
     $placeholder = $options['placeholder'] ?? $title ;      
     $value = $options['value'] ?? '';    
     if($value === '01/01/1970') $value='';      
     $format = $options['format'] ?? "d/m/Y";     
@endphp
<div class="flatpickr-input-container mb-2">       
    <input @if ($value!=='') value={{$value}} @endif  type="text" name="{{ $name }}" id="{{ $id }}" class="form-control ps-6 datetimepicker flatpickr flatpickr-input" placeholder="{{ $placeholder  ?? 'Select Date' }}" />      
    <span class="far fa-calendar-plus flatpickr-icon" style="top:58%"></span>
</div>
@section('jsFooter') 
@parent
<script>
    $('.flatpickr-input').flatpickr({        
        dateFormat: "{{$format}}",
        allowInput:true
    });
</script>
@endsection