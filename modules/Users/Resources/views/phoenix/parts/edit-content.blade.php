@php   
  // stringFormatDate($data['user']->birthday,'d/m/Y')
  // dd(getGroupName());  
    //dd($data['user']);
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
        'value' => stringFormatDate($data['user']->birthday,'d/m/Y')
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
    'avatar' => [
        'value' => $data['user']->avatar,
    ],
    'groups' => [
        'title' => 'Groups Name',
        'name' => 'group_id',
        'select' => $groupname,
        'selected' => $data['user']->group_id
    ],
    'active' => [
        'title' => 'Kích hoạt',
        'name' => 'status',    
        'checked' => $data['user']->status  
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
            <div class="col-3">            
                <x-input-text :options="$options['name']"/>                
                <x-input-date :options="$options['birthday']"/>
                <x-input-text :options="$options['phone']"/>
                <x-input-text :options="$options['email']"/>
                <x-input-text :options="$options['password']"/>        
                <x-input-select :options="$options['groups']"/>  
                <x-input-check :options="$options['active']"/>                  
            </div>
            <div class="col-3">
                <h4 class="mt-4">Ảnh đại diện</h4>   
                  <x-input-file :options="$options['avatar']" />                   
                </div>  
            </div>
        </div>
        <hr />
        <div class="d-flex mb-3">
            <a href="{{route('users.index')}}" class="btn btn-phoenix-primary me-2 px-6">Hủy</a>
            <button class="btn btn-primary" type="submit">Cập nhật</button>
        </div>
        
    </div>
</form>
