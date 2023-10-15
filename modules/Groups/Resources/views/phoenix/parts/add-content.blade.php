@php
  $options = [
    'name' => [
        'name' => 'name',
        'title' => 'Tên Nhóm'
    ], 
];  

@endphp
<form method="POST" action="#">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="d-sm-flex justify-content-between mt-4">
                    <h2 class="mb-4">Thêm Nhóm mới</h2>                
                </div>
                <hr />
            </div>
        </div>
        
        <div class="row">
            <div class="col-6">            
                <x-input-text :options="$options['name']"/>     
                
            </div>
        </div>
        <hr />
        <div class="d-flex mb-3">
            <button class="btn btn-phoenix-primary me-2 px-6">Hủy</button>
            <button class="btn btn-primary" type="submit">Thêm mới</button>
        </div>
        
    </div>
</form>
