<h3>
    Trạng thái kết nối database:
    @if ($connect)
        <span style="color:green">{{'Đang kết nối'}}</span>
    @else
        <span style="color:red">{{'Kết nối thất bại'}}</span>        
    @endif
</h3>
<form action="{{route('env.postEnv')}}" method="post">
    @csrf  
    <label for="" style="font-weight:800">Thêm tham số </label>
    <input type="text" name='key' placeholder="KEY"/>
    <input type="text" name='value' placeholder="VALUE"/>
    <input type="submit" value="Thêm" name="action"/>
</form>

<h3>{{$title}}</h3>
<hr />
@if (session('status'))
    <div class="alert alert-outline-success">
        <h3>{{ session('status') }}</h3>
    </div>
@endif
<form action="{{route('env.postEnv')}}" method="post">
    <label for="" style="font-weight:800">Xóa tham số </label>
    <input type="text" name='key' placeholder="KEY"/>
    <input type="submit" value="Xóa" name="action"/>
    <hr />
    @csrf    
    @foreach ($envArray as $key => $value)
        @if ($key !=='')
            <label for="">{{$key}}</label>
            <input type="text" name='{{$key}}' value='{{$value}}' />            
            <br />    
        @endif
    @endforeach      
    <input type="submit" value="Cập nhật" />
</form>


<script>        
    document.addEventListener('DOMContentLoaded', function(event) {
        
    });
</script>
