@php
    //dd($data['data']);
@endphp
@if (session('msg'))
    <div class="alert alert-outline-success">{{session('msg')}}</div>
@endif 
<h3>Danh sách nhóm</h3> 
@can('create', Modules\Groups\Models\Groups::class)
            <a class="btn btn-primary mt-2" href="{{route('groups.add')}}">Thêm mới</a> 
@endcan
<hr />
<table class="table">
  <thead>
    <tr>             
         <th>ID</th>
         <th>Group Name</th>
         <th>Action</th>
         
    </tr>
  </thead>
  <tbody>
    @if (count($data['data']) > 0)
      @foreach ($data['data'] as $item)
      <tr>             
        <td>{{$item['id']}}</td>
        <td>{{$item['name']}}</td>
        <td>
          <div class="row">
              <div class="col-3">
                <a href="{{route('groups.permission',$item)}}">Phân quyền</a>                 
              </div>
              <div class="col-2"><a href="#">Sửa</a></div>
              <div class="col-2"><a href="#">Xóa</a></div>
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