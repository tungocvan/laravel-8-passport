@php
  $groupname = [];
  foreach (getGroupName() as $item) {
        $groupname[] = [
            'value' => $item['id'],
            'title' => $item['name']
        ];
    }
  $options = [
    'name' => [
        'name' => 'name',
        'title' => 'Họ và tên',
        'value' => old('name')
    ],   
    'email' => [
        'name' => 'email',
        'title' => 'Địa chỉ email',
        'value' => old('email')
    ],
    'birthday' => [
        'name' => 'birthday',
        'title' => 'Sinh nhật',
        'value' => old('birthday')
    ],
    'phone' => [
        'name' => 'phone',
        'title' => 'Số điện thoại',
        'value' => old('phone')
    ],
    'password' => [
        'name' => 'passwordLogin',
        'title' => 'Mật khẩu',
        'type' => 'password'
    ],
    'groups' => [
        'title' => 'Groups Name',
        'select' => $groupname,
        'selected' => 4,
        'name' => 'group_id'
    ]
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
            <div class="col-3">            
                <x-input-text :options="$options['name']"/>                
                <x-input-date :options="$options['birthday']"/>
                <x-input-text :options="$options['phone']"/>
                <x-input-text :options="$options['email']"/>
                <x-input-text :options="$options['password']"/>   
                <x-input-select :options="$options['groups']"/>             
            </div>
            <div class="col-3">
                <h4 class="mt-4">Ảnh đại diện</h4>   
                <x-input-file />      
            </div>
        </div>
        <hr />
        <div class="d-flex mb-3">
            <a href="{{route('users.index')}}" class="btn btn-phoenix-primary me-2 px-6">Hủy</a>
            <button class="btn btn-primary" type="submit">Thêm mới</button>
        </div>
        
    </div>
</form>
