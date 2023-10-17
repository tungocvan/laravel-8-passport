@php    
    $category = $data['category'];
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
        'description' => [
            'title' => 'Mô tả',
            'name' => 'description'
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
                <form method="POST" action="{{ route('post.post-add') }}">
                    @csrf
                <x-input-text :options="$options['name']"/> 
                <x-input-text :options="$options['slug']"/> 
                {{-- <x-input-select :options="$options['slugParent']"/>                   --}}
                <select class="form-select mb-2" aria-label="Default select" name="category[]">
                     {!!getCategoriesOptions($category)!!}
                </select>
                <x-input-text-area :options="$options['description']"/>
                <div class="d-sm-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary"> Thêm chuyên mục</button>                       
                </div>
                </form>
            </div>            
            <div class="col-8">
                <div class="d-sm-flex justify-content-between mt-4">
                      <table class="table">
                        <thead>
                            <tr>             
                                 <th>ID</th>
                                 <th>Name</th>
                                 <th>Mô tả</th>                                 
                                 <th>Slug</th>                                 
                            </tr>
                          </thead>
                          <tbody>
                            @if (count($data['data']) > 0)
                            @foreach ($data['data'] as $item)
                            <tr>             
                              <td>{{$item['term_id']}}</td>
                              <td>{{$item['name']}}</td>
                              <td>{{$item->termTaxonomy->description}}</td>
                              <td>{{$item['slug']}}</td>
                              <td>
                                <div class="row">                                 
                                    <div class="col-2"><a href="#">Sửa</a></div>
                                    <div class="col-2"><a href="#">Xóa</a></div>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          @endif
                          </tbody>
                      </table>      
                </div>
                <hr />
            </div>            
        </div>
    </div>
