@php    
    $category = $data['category'];      
    $parent = $data['parent'] ?? 0;  
    $key = $data['key'] ?? -1;     
    $id = request()->id ?? 0;
    $options = [
        'name' => [
            'name' => 'name',
            'title' => 'Tên',
            'value' => $data['editData'][$key]->name ?? old('name')
        ], 
        'slug' => [
            'name' => 'slug',
            'title' => 'Đường dẫn',
            'value' => $data['editData'][$key]->slug ?? old('slug')
        ],    
        'description' => [
            'title' => 'Mô tả',
            'name' => 'description',
            'value' => $data['description'] ?? old('description')
        ],
    ];
@endphp

    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="d-sm-flex justify-content-between mt-4">
                    <h4 class="mb-4">Thêm chuyên mục</h4>                       
                </div>
                <hr /> 
                    <form method="POST" action="{{ route('post.post-add-category') }}">
                    @csrf
                <x-input-text :options="$options['name']"/> 
                <x-input-text :options="$options['slug']"/> 
                {{-- <x-input-select :options="$options['slugParent']"/>                   --}}
                <select class="form-select mb-2" aria-label="Default select" name="category[]">
                    <option selected="" value="0">Root</option>
                     {!!getCategoriesOptions(['data' => $category,  'parent' => $parent])!!}
                </select>
                <x-input-text-area :options="$options['description']"/>
                <div class="d-sm-flex justify-content-between mt-4">
                    @if ($id)
                          <input hidden type="text" name='id' value={{$id}} />  
                          <button type="submit" class="btn btn-primary"> cập nhật chuyên mục</button> 
                    @else
                         <button type="submit" class="btn btn-primary"> Thêm chuyên mục</button> 
                    @endif
                                          
                </div>
                </form>
            </div>            
            <div class="col-8">
                <div class="d-sm-flex justify-content-between mt-4">
                      
                </div>
                <hr />
                {{ getCategoriesTable($data['data']) }} 
            </div>            
        </div>
    </div>
