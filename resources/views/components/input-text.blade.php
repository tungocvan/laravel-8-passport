@php    
     
     $number = (string) rand(10,99);
     $name = $options['name'] ?? 'name_'.$number;
     $id =   $options['id'] ?? $name;
     $title= $options['title'] ?? '' ;
     $placeholder = $options['placeholder'] ?? $title ;     
     $value = $options['value'] ?? '';     
     $type = $options['type'] ?? 'text'
@endphp
<div class="row mb-3">
    @if ($title !=='')
        <label class="col-md-4 col-form-label text-md-end" for="{{ $name }}">{{ __($title) }}</label>        
    @endif
    <div class="col-md-6">
        <input class="form-control @error($name) is-invalid @enderror"  type="{{$type}}" name="{{ $name }}"  id="{{ $id }}"  @if($placeholder !=='') placeholder="{{$placeholder}}" @endif   @if($value !=='') value="{{ old($name) }}" @endif />   
        @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>