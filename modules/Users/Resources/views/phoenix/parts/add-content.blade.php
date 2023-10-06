@php
  $options = [
    'name' => [
        'name' => 'name',
        'title' => 'Họ và tên'
    ],
    'username' => [
        'name' => 'username',
        'title' => 'Tên Đăng Nhập'
    ],
    'email' => [
        'name' => 'email',
        'title' => 'Địa chỉ email'
    ],
    'birthday' => [
        'name' => 'birthday',
        'title' => 'Sinh nhật'
    ],
    'phone' => [
        'name' => 'phone',
        'title' => 'Số điện thoại'
    ],
    'password' => [
        'name' => 'password',
        'title' => 'Mật khẩu',
        'type' => 'password'
    ],
];  

@endphp
<form method="POST" action="{{ route('users.post-add') }}" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="d-sm-flex justify-content-between mt-4">
                    <h2 class="mb-4">Thêm mới thành viên</h2>                
                </div>
                <hr />
            </div>
        </div>
        
        <div class="row">
            <div class="col-6">            
                <x-input-text :options="$options['name']"/>
                <x-input-text :options="$options['username']"/>
                <x-input-date :options="$options['birthday']"/>
                <x-input-text :options="$options['phone']"/>
                <x-input-text :options="$options['email']"/>
                <x-input-text :options="$options['password']"/>
                
            </div>
        </div>
        <hr />
        <div class="d-flex mb-3">
            <button class="btn btn-phoenix-primary me-2 px-6">Hủy</button>
            <button class="btn btn-primary" type="submit">Thêm mới</button>
        </div>
        
    </div>
</form>
<div class="row">
    <x-input-file />
</div>