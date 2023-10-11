@php  
  
  $options = [
    'name' => [
        'name' => 'name',
        'title' => 'Họ và tên',
        'value' => $data['user']->name
    ],
    'email' => [
        'name' => 'email',
        'title' => 'Địa chỉ email',
        'value' => $data['user']->email,
        'disable' => true
    ],
    'birthday' => [
        'name' => 'birthday',
        'title' => 'Sinh nhật',
        'value' => $data['user']->birthday
    ],
    'phone' => [
        'name' => 'phone',
        'title' => 'Số điện thoại',
        'value' => $data['user']->phone
    ],
    'password' => [
        'name' => 'password',
        'title' => 'Mật khẩu',
        'type' => 'password',
        'value' => $data['user']->password
    ],
];  

@endphp
<form method="POST" action="{{ route('users.post-edit',$data['user']->id) }}" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="d-sm-flex justify-content-between mt-4">
                    <h2 class="mb-4">Sửa thông tin thành viên</h2>                
                </div>
                <hr />
            </div>
        </div>
        
        <div class="row">
            <div class="col-6">            
                <x-input-text :options="$options['name']"/>                
                <x-input-date :options="$options['birthday']"/>
                <x-input-text :options="$options['phone']"/>
                <x-input-text :options="$options['email']"/>
                <x-input-text :options="$options['password']"/>
                
            </div>
        </div>
        <hr />
        <div class="d-flex mb-3">
            <a href="{{route('users.index')}}" class="btn btn-phoenix-primary me-2 px-6">Hủy</a>
            <button class="btn btn-primary" type="submit">Cập nhật</button>
        </div>
        
    </div>
</form>
