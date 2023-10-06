@php         
     $number = (string) rand(10,99);
     $name = $options['name'] ?? 'name_'.$number;
     $id =   $options['id'] ?? $name;
     $title= $options['title'] ?? '' ;
     $placeholder = $options['placeholder'] ?? $title ;     
     $value = $options['value'] ?? '';     
     $type = $options['type'] ?? 'text'
@endphp
<div class="col-sm-6 col-md-4 mb-2">
    <div class="form-floating">
        <input class="form-control @error($name) is-invalid @enderror"  type="{{$type}}" name="{{ $name }}"  id="{{ $id }}"  @if($placeholder !=='') placeholder="{{$placeholder}}" @endif   @if($value !=='') value="{{ old($name) }}" @endif />   
        @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        @if ($title !=='')
            <label class="col-md-4 col-form-label" for="{{ $name }}">{{ __($title) }}</label>        
        @endif
    </div>
</div>

