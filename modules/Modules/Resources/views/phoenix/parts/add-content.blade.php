@php
  $options = [
    'name' => [
        'name' => 'name',
        'title' => 'Tên Module'
    ],
    'description' => [
        'name' => 'description',
        'title' => 'Mô tả chức năng Module'
    ],   
];  

@endphp
<form method="POST" action="{{ route('modules.post-add') }}">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-sm-flex justify-content-between mt-4">
                    <h2 class="mb-4">Thêm mới thành viên</h2>                
                </div>
                <hr />
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">            
                <x-input-text :options="$options['name']"/>
                <x-input-text :options="$options['description']"/>    
                
            </div>
        </div>
        <hr />
        <div class="d-flex mb-3">
            <button class="btn btn-phoenix-primary me-2 px-6">Hủy</button>
            <button class="btn btn-primary" type="submit">Thêm mới</button>
        </div>
        
    </div>
</form>
