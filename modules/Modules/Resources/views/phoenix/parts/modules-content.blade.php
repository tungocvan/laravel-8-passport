@php
    //dd($data['data']);
@endphp
@if (session('msg'))
    <div class="alert alert-outline-success mt-2">{{session('msg')}}</div>
@endif 

<div class="row py-2">
    <div class="col-6 mt-2">
        <h3>Danh sách nhóm</h3>
        <a class="btn btn-primary mt-2" href="{{route('modules.add')}}">Thêm mới</a> 
    </div>
</div>
<hr />
<table class="table">
  <thead>
    <tr>             
         <th>ID</th>
         <th>Module Name</th>
         <th>Description</th>
         <th>Action</th>
         
    </tr>
  </thead>
  <tbody>
    @if (count($data['data']) > 0)
      @foreach ($data['data'] as $item)
      <tr>             
        <td>{{$item['id']}}</td>
        <td>{{$item['name']}}</td>
        <td>{{$item['title']}}</td>        
        <td>
          <div class="row">   
              <div class="col-4"><a class="btn btn-success" href="{{route('modules.edit',$item)}}">Sửa</a></div>
              <div class="col-4"><a class="btn btn-danger" href="{{route('modules.post-delete',$item['id'])}}">Xóa</a></div>
          </div>
        </td>
      </tr>
      @endforeach
    @endif
    
  </tbody>
</table>
<script>        
    document.addEventListener('DOMContentLoaded', function(event) {
        
    });
</script>