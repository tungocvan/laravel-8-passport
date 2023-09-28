@php
  $styleBasic = $options['style'] ?? false;
  $id = $options['id'] ?? 'editor1';
  $name = $options['name'] ?? $id;
  $row = $options['rows'] ?? 10;
  $cols =$options['cols'] ?? 80;
  $content = $options['content'] ?? 'Ckeditor' ;
@endphp
<div class="py-2">
    <textarea name={{ $name }}  id={{$id}} rows={{ $row }} cols={{ $cols }}>
        {{ $content }}
    </textarea>
</div>

@section('jsHead') 
  @parent
  {{-- <script src="/plugin/ckeditor/ckeditor.js"></script> --}}
@endsection


@if($styleBasic)
<script>
  // Replace the <textarea id="editor1"> with a CKEditor 4
  // instance, using default configuration.
  // https://ckeditor.com/docs/ckeditor4/latest/examples/removeformat.html
  CKEDITOR.replace( {{ $options['id'] ?? 'editor1' }},{
    // removeButtons: '',
    // removeButtons: 'PasteFromWord',     
    toolbarGroups: [{
          name: 'basicstyles',
          groups: ['basicstyles', 'cleanup']
    },{
      name: 'colors'
    }]
  } );
</script> 
@else
<script>
  // Replace the <textarea id="editor1"> with a CKEditor 4
  // instance, using default configuration.
  // https://ckeditor.com/docs/ckeditor4/latest/examples/removeformat.html
  CKEDITOR.replace( {{ $options['id'] ?? 'editor1' }},{
    
  } );
</script>
@endif



