{{-- https://unisharp.github.io/laravel-filemanager/integration --}}
@php         
     $number = (string) rand(10,99);
     $name = $options['name'] ?? 'filepath';
     $id =   $options['id'] ?? $name.'_'.$number;
     $value = $options['value'] ?? '';
@endphp
<div class='row mb-3'> 
<div class='input-group'>
    <span class='input-group-btn'>
      <a id='{{ $id }}' data-input='thumbnail_{{$id}}' data-preview='holder_{{$id}}' class='btn btn-primary flm'>
        <i class='fa fa-picture-o'></i> Choose
      </a>
    </span>
    <input id='thumbnail_{{$id}}' class='form-control' type='text' name='{{ $name }}[]' @if($value !=='') value={{$value}}  @endif >
  </div>
<div id='holder_{{$id}}' style='margin-top:15px;max-height:100px;'>
      @if ($value)
          <img src="{{$value}}" style="height: 5rem;">
      @endif
</div>      
</div>
@section('jsFooter')
@parent
<script src='/vendor/laravel-filemanager/js/stand-alone-button.js'></script>
<script>
    $('.flm').filemanager('image');
</script>
@endsection

{{-- <div class='row mb-3'> 
<div class="p-4 code-to-copy">
  <div class="dropzone dropzone-multiple p-0">      
      <div class="dz-message">
        <div class="dz-message-text">          
          <label for="dropzone">
            <input id="dropzone" type="file" name="file" for="dropzone"/>
            <img class="me-2" src="https://prium.github.io/phoenix/v1.10.0/assets/img/icons/cloud-upload.svg" width="25" alt="" />
              Drop your file here
          </label>
          
        </div>
      </div>     
    </div>
</div>
</div> --}}
