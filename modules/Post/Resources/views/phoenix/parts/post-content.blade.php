@php
    $posts = $data['allPost']
@endphp
<h4 class="my-2">DANH SÁCH BÀI VIẾT</h4>
<hr />

@if (session('msg'))
    <div class="alert alert-outline-success mt-2">{{session('msg')}}</div>
@endif 

<div class="pb-6">
    <div class="table-responsive scrollbar mx-n1 px-1 border-top">
        <table class="table fs--1 mb-0 leads-table">
            <thead>
                <tr>
                  <th class="white-space-nowrap fs--1 align-middle ps-0">ID</th>                  
                  <th class="white-space-nowrap fs--1 align-middle ps-0">Title</th>                                    
                  <th class="white-space-nowrap fs--1 align-middle ps-0">Action</th>                                    
                </tr>
            </thead>
              <tbody class="list" id="deal-tables-body">
                @foreach ($posts as $key => $post)    
                    <tr class="hover-actions-trigger btn-reveal-trigger position-static">                        
                        <td class="align-middle white-space-nowrap fw-semi-bold text-1000 ps-4 border-end">{{$post->ID}}</td>                 
                        <td class="align-middle white-space-nowrap fw-semi-bold text-1000 ps-4 border-end">{{$post->post_title}}</td>                                                          
                        <td class="align-middle white-space-nowrap fw-semi-bold text-1000 ps-4 border-end">
                            <a class="btn btn-success" href="{{route('post.post-edit',$post->ID)}}">Sửa</a>
                            <a class="btn btn-danger" href="{{route('post.post-delete',$post->ID)}}">Xóa</a>
                        </td>                                                          
                    </tr>
                @endforeach
              </tbody>
        </table>
    </div>
    <div class="pagination  mt-4 justify-content-end">
        {{$posts->links()}}
    </div>
</div>  