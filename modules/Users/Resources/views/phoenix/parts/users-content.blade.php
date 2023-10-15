@php    
    $options = [
        'valueNames' => [ 'name', 'Email','Phone','Contact Name', 'Company Name', 'Create Date' ]
    ];    
@endphp
@if (session('msg'))
    <div class="alert alert-outline-success mt-2">{{session('msg')}}</div>
@endif 

    <div class="row py-2">
        <div class="col-6 mt-2">
            <h3>Danh sách Thành viên</h3>
            @can('create', Modules\Users\Models\Users::class)
            <a class="btn btn-primary mt-2" href="{{route('users.add')}}">Thêm mới</a> 
            @endcan
        </div>
    </div>
    <hr /> 



<div class="pb-6">
<div class="table-responsive scrollbar mx-n1 px-1 border-top">
    <table class="table fs--1 mb-0 leads-table">
        <thead>
            <tr>
              <th class="white-space-nowrap fs--1 align-middle ps-0" style="max-width:20px; width:18px;">
                <div class="form-check mb-0 fs-0">
                    <input class="form-check-input" type="checkbox" />
                </div>
              </th>
              <th class="sort white-space-nowrap align-middle text-uppercase" scope="col" data-sort="name" style="width:25%;">Name</th>
              <th class="sort align-middle ps-4 pe-5 text-uppercase border-end" scope="col" data-sort="email" style="width:15%;">
                <div class="d-inline-flex flex-center">
                  <div class="d-flex align-items-center px-1 py-1 bg-success-100 rounded me-2">
                    <span class='nav-link-icon text-danger fas fa-id-card' style='height: 16px; width: 16px;color:#3e456b!important'></span>
                  </div>
                  <span>Email</span>
                </div>
              </th>             
              <th class="sort align-middle ps-4 pe-5 text-uppercase" scope="col" data-sort="date" style="width:15%;">Birthday</th>
              <th class="sort align-middle ps-4 pe-5 text-uppercase" scope="col" data-sort="date" style="width:15%;">Phone</th>
              <th class="sort align-middle ps-4 pe-5 text-uppercase" scope="col" data-sort="date" style="width:15%;">Group Name</th>
              <th class="sort align-middle ps-4 pe-5 text-uppercase" scope="col" data-sort="date" style="width:15%;">Create date</th>
              <th class="sort text-end align-middle pe-0 ps-4" scope="col"></th>
            </tr>
        </thead>
          <tbody class="list" id="deal-tables-body">
            @foreach ($data as $key => $item)    
                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                    <td class="fs--1 align-middle">
                      <div class="form-check mb-0 fs-0"><input class="form-check-input" type="checkbox" data-bulk-select-row="{&quot;customer&quot;:{&quot;avatar&quot;:&quot;/team/32.webp&quot;,&quot;name&quot;:&quot;Anthoney Michael&quot;,&quot;designation&quot;:&quot;VP Accounting&quot;,&quot;status&quot;:{&quot;label&quot;:&quot;new lead&quot;,&quot;type&quot;:&quot;badge-phoenix-primary&quot;}},&quot;email&quot;:&quot;anth125@gmail.com&quot;,&quot;phone&quot;:&quot;+1-202-555-0126&quot;,&quot;contact&quot;:&quot;Ally Aagaard&quot;,&quot;company&quot;:&quot;Google.inc&quot;,&quot;date&quot;:&quot;Jan 01, 12:56 PM&quot;}"></div>
                    </td>
                    <td class="name align-middle white-space-nowrap">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl me-3"><img class="rounded-circle" src="{{$item['avatar']}}" alt=""></div>
                            <div><a class="fs-0 fw-bold" href="#!">{{$item['name']}}</a>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 text-1000 fw-semi-bold fs--1 me-2">{{$item['provider']}}</p>                                
                                @if ($item['status'] === 0)
                                <span class="badge badge-phoenix badge-phoenix-danger">No Active</span>
                                @else
                                <span class="badge badge-phoenix badge-phoenix-primary">Active</span>
                                @endif
                            </div>
                            </div>
                        </div>
                    </td>
                    <td class="email align-middle white-space-nowrap fw-semi-bold text-1000 ps-4 border-end">{{$item['email']}}</td>
                    <td class="email align-middle white-space-nowrap fw-semi-bold text-1000 ps-4 border-end">
                    @if ($item['birthday'] !== null)                                                              
                              {{stringFormatDate($item['birthday'],'d-m-Y')}}                                      
                    @endif   
                                   
                    </td>
                    <td class="email align-middle white-space-nowrap fw-semi-bold text-1000 ps-4 border-end">{{$item['phone']}}</td>
                    <td class="phone align-middle white-space-nowrap fw-semi-bold text-1000 ps-4 border-end">{{$item['group']->name}}</td>
                    <td class="phone align-middle white-space-nowrap fw-semi-bold text-1000 ps-4 border-end">{{$item['created_at']->format('Y-m-d')}}</td>
                    <td class="align-middle white-space-nowrap text-end pe-0 ps-4">
                        <div class="font-sans-serif btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><svg class="svg-inline--fa fa-ellipsis fs--2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M120 256C120 286.9 94.93 312 64 312C33.07 312 8 286.9 8 256C8 225.1 33.07 200 64 200C94.93 200 120 225.1 120 256zM280 256C280 286.9 254.9 312 224 312C193.1 312 168 286.9 168 256C168 225.1 193.1 200 224 200C254.9 200 280 225.1 280 256zM328 256C328 225.1 353.1 200 384 200C414.9 200 440 225.1 440 256C440 286.9 414.9 312 384 312C353.1 312 328 286.9 328 256z"></path></svg><!-- <span class="fas fa-ellipsis-h fs--2"></span> Font Awesome fontawesome.com --></button>
                        <div class="dropdown-menu dropdown-menu-end py-2">
                            @can('update',Modules\Users\Models\Users::class)
                            <a class="dropdown-item" href="{{route('users.edit',$item)}}">Sửa</a>
                            @endcan
                            <a class="dropdown-item" href="#!">Export</a>
                            @can('delete',Modules\Users\Models\Users::class)
                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="{{route('users.delete',$item['id'])}}">Xóa</a>
                            @endcan
                        </div>
                        </div>
                    </td>
                </tr>
            @endforeach
          </tbody>
    </table>
</div>
<div class="pagination  mt-4 justify-content-end">
    {{$data->links()}}
</div>

</div>
