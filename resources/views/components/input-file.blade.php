{{-- https://unisharp.github.io/laravel-filemanager/integration --}}
@php         
     $number = (string) rand(10,99);
     $name = $options['name'] ?? 'filepath';
     $id =   $options['id'] ?? $name.'_'.$number;
@endphp
<div class="row mb-3"> 
<div class="input-group">
    <span class="input-group-btn">
      <a id="{{ $id }}" data-input="thumbnail_{{$id}}" data-preview="holder_{{$id}}" class="btn btn-primary flm">
        <i class="fa fa-picture-o"></i> Choose
      </a>
    </span>
    <input id="thumbnail_{{$id}}" class="form-control" type="text" name="{{ $name }}[]"  >
  </div>
<div id="holder_{{$id}}" style="margin-top:15px;max-height:100px;"></div>
</div>
@section('jsFooter')
@parent
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('.flm').filemanager('image');
</script>
@endsection