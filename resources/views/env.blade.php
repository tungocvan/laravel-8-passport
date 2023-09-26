<h3>Thiết lập thông số Website</h3>
@if (session('status'))
    <div class="alert alert-success">
        <h3>{{ session('status') }}</h3>
    </div>
@endif
<form action="{{route('postEnv')}}" method="post">
    @csrf    
    @foreach ($envArray as $key => $value)
        @if ($key !=='')
            <label for="">{{$key}}</label>
            <input type="text" name='{{$key}}' value='{{$value}}' />
            <br />    
        @endif
    @endforeach      
    <input type="submit" value="submit" />
</form>

