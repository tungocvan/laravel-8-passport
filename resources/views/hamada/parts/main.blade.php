@php
  $options = ['id' => 'editor2'];
  $txtName = ['placeholder' => 'full name..'];

@endphp
@section('jsHead')
@parent
<script src="/plugin/ckeditor/ckeditor.js"></script>
<script src="/plugin/flatpickr/dist/flatpickr.min.js"></script>
@endsection
<h4>MAIN HAMADA</h4>
<x-upload-file />

<x-input-text />
<div class="container">
    <div class="row">
        <div class="col-6">
           <x-editor  />
        </div>        
      
        <div class="col-6">
           <x-editor :options="$options" />
        </div>        
      
    </div>
    <div class="row">        
        <div class="col-3">
          <x-input-date />
        </div>
        <div class="col-3">
          <x-input-file />
        </div>
        <div class="col-3">
          <x-input-file />
        </div>
    </div>
</div>

