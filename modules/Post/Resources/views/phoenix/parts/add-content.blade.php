@php
    $category = $data['category'];    
    $parent = $data['parent'] ?? 0; 
    $options = [
        'name' => [
            'name' => 'title',
            'title' => 'Thêm tiêu đề'            
        ],
        'avatar' => [
            'name' => 'thumnail',
        ],
];
@endphp
<h4 class="my-4">THÊM BÀI VIẾT</h4>
<form method="POST" action="{{ route('post.post-add')}}">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-8">
                <x-input-text :options="$options['name']"/>
                <x-editor />
                <hr />
                <div class="d-flex mb-3">
                    <a href="{{route('post.index')}}" class="btn btn-phoenix-primary me-2 px-6">Hủy</a>
                    <button class="btn btn-primary" type="submit">Lưu bài viết</button>
                </div>
            </div>
            <div class="col-4">
                <h4 class="my-4">Chuyên mục</h4>
                <div class="scrollable-div">
                   {!!getCategoriesPost(['data' => $category,  'parent' => $parent])!!}
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
