@php         
     $number = (string) rand(10,99);
     $name = $options['name'] ?? 'name_'.$number;
     $id =   $options['id'] ?? $name;
     $title= $options['title'] ?? '' ;
     $placeholder = $options['placeholder'] ?? $title ;     
     $value = $options['value'] ?? '';     
     $type = $options['type'] ?? 'text';
     $disable = $options['disable'] ?? false;
@endphp
<div class="form-floating mb-2">
    <input class="form-control @error($name) is-invalid @enderror"  type="{{$type}}" name="{{ $name }}"  id="{{ $id }}"  @if($placeholder !=='') placeholder="{{$placeholder}}" @endif   @if($value !=='') value="{{ $value }}" @endif @if($disable === true) disabled=true  @endif />   
    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    @if ($title !=='')
        <label class="col-md-4 col-form-label" for="{{ $name }}">{{ __($title) }}</label>        
    @endif
</div>


