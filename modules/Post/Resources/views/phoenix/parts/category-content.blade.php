@php
    $options = [
        'name' => [
            'name' => 'name',
            'title' => 'Tên',
            'value' => old('name')
        ], 
        'slug' => [
            'name' => 'slug',
            'title' => 'Đường dẫn',
            'value' => old('slug')
        ], 
        'slugParent' => [
            'title' => 'Chuyên mục cha',
            'select' => [['value' => 1, 'title' => 'News'],['value' => 2, 'title' => 'Sport'],],
            'selected' => 1,
            'name' => 'slug_parent'
        ],
        'description' => [
            'title' => 'Mô tả',
            'name' => 'description'
],
    ];
@endphp
<form method="POST" action="{{ route('post.post-add') }}">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="d-sm-flex justify-content-between mt-4">
                    <h4 class="mb-4">Thêm chuyên mục</h4>                       
                </div>
                <hr />
                <x-input-text :options="$options['name']"/> 
                <x-input-text :options="$options['slug']"/> 
                <x-input-select :options="$options['slugParent']"/> 
                <x-input-text-area :options="$options['description']"/>
                <div class="d-sm-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary"> Thêm chuyên mục</button>                       
                </div>
            </div>            
            <div class="col-8">
                <div class="d-sm-flex justify-content-between mt-4">
                            
                </div>
                <hr />
            </div>            
        </div>
    </div>
</form>