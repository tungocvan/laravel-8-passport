@php         
     $number = (string) rand(10,99);
     $name = $options['name'] ?? 'name_'.$number;
     $id =   $options['id'] ?? $name;
     $title= $options['title'] ?? '' ;      
     $value = $options['value'] ?? '';     
     $rows = $options['rows'] ?? 5;    
     $height =  $options['height'] ?? '160px';  
@endphp
<div class="form-floating mb-2">  
    @if ($title !=='')
        <label class="form-label mb-2" for="{{ $name }}">{{ __($title) }}</label>        
    @endif  
    <textarea style="height:{{$height}}" class="form-control pt-5  @error($name) is-invalid @enderror"  rows="{{$rows}}" name="{{ $name }}"  id="{{ $id }}" @if($value !=='') value="{{ $value }}" @endif >{{ $value }}</textarea>
    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
   
</div>


