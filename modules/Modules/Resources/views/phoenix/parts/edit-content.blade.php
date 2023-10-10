@php
  //dd($data['module']);
  $options = [
    'name' => [
        'name' => 'name',
        'title' => 'Tên Module',
        'value' => $data['module']->name
    ],
    'description' => [
        'name' => 'description',
        'title' => 'Mô tả chức năng Module',
        'value' => $data['module']->title
    ],   
];  

@endphp
<form method="POST" action="{{ route('modules.post-edit',$data['module']->id) }}">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-sm-flex justify-content-between mt-4">
                    <h2 class="mb-4">Cập nhật lại Module</h2>                
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
            <button class="btn btn-primary" type="submit">Cập nhật</button>
        </div>
        
    </div>
</form>
