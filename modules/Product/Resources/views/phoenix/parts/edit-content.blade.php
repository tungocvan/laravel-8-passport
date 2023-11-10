@php
    $post = $data['post'];
    $category = $data['category'];
    $checked = $data['checked'];  
    
    $parent = $data['parent'] ?? 0; 
   
    $options = [
        'post_title' => [
            'name' => 'post_title',
            'title' => 'Thêm tiêu đề',
            'value' => $post->post_title             
        ],
        'avatar' => [
            'name' => 'thumnail',
            'value' =>  $data['meta']['_thumbnail_id']
        ],
        'post_excerpt' => [
            'name' => 'post_excerpt',
            'style' => true,
            'content' => $post->post_excerpt
        ],
        'post_content' => [
            'name' => 'post_content',
            'content' => $post->post_content
        ],
        'price' => [
            'name' => '_price',
            'title' => 'Giá bán thường (₫)',
            'value' =>  $data['meta']['_price']
        ],
        'regular_price' => [
            'name' => '_regular_price',
            'title' => 'Giá khuyến mãi (₫)',
            'value' =>  $data['meta']['_regular_price']
        ],
];

@endphp
<h4 class="my-4">SỬA SẢN PHẨM</h4>
<form method="POST" action="{{ route('product.product-edit',$post->ID)}}">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-8">
                <x-input-text :options="$options['post_title']"/>
                <h4 class="my-4">Mô tả ngắn của sản phẩm</h4>
                <x-editor :options="$options['post_excerpt']" />
                <h4 class="my-4">Chi tiết sản phẩm</h4>
                <x-editor :options="$options['post_content']" />
                <div class="d-flex mb-3">
                    <x-input-text :options="$options['price']"/>
                    <div class="mx-2"></div>
                    <x-input-text :options="$options['regular_price']"/>
                </div>
                <hr />
                <div class="d-flex mb-3">
                    <a href="{{route('product.index')}}" class="btn btn-phoenix-primary me-2 px-6">Hủy</a>
                    <button class="btn btn-primary" type="submit">Lưu sản phẩm</button>
                </div>
            </div>
            <div class="col-4">
                <h4 class="my-4">Chuyên mục</h4>
                <div class="scrollable-div">
                {!!getCategoriesProduct(['data' => $category,  'parent' => $parent, 'checked' => $checked])!!}
                </div>
                <h4 class="my-4">Ảnh đại diện</h4>
                <x-input-file :options="$options['avatar']" /> 
            </div>
        </div>
    </div>
</form>
@section('jsHead')
@parent
<script src="/plugin/ckeditor/ckeditor.js"></script>
<script src="/plugin/flatpickr/dist/flatpickr.min.js"></script>
@endsection