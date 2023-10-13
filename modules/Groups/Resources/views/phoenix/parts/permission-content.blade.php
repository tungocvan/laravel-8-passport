@php
    //dd($data['data']['group']->name);
    $nameModule = $data['data']['group']->name ?? '';
    $modules = $data['data']['modules'];
    $group = $data['data']['group'];
    $roleListArr = $data['data']['roleListArr'];
    $roleArr = $data['data']['roleArr'];
    
@endphp
<h3>Phân quyền nhóm - {{ $nameModule}}</h3>
<form method="POST" action="{{route('groups.post-permission',$group)}}">
    <table class="table">
        <thead>
          <tr>  
               <th width="15%">Modules</th>
               <th>Quyền</th>               
          </tr>
        </thead>
        <tbody>
    @if ($modules->count() > 0)
    
        @foreach ($modules as $module)
            <tr>
                <td>{{$module->title}}</td>
                <td>
                    <div class="row">
                        @if (!empty($roleListArr))
                          @foreach ($roleListArr as $roleName => $roleLabel)
                              <div class="col-2">
                                <label for="role_{{$module->name}}_{{$roleName}}">
                                    <input type="checkbox" name="role[{{$module->name}}][]" id="role_{{$module->name}}_{{$roleName}}" value="{{$roleName}}"
                                    {{ isRole($roleArr,$module->name,$roleName) ? 'checked':false }}
                                    />
                                    {{$roleLabel}}
                                </label>
                              </div>
                          @endforeach  
                        @endif
                        @if ($module->name == 'Groups')
                            <div class="col-3">
                                <label for="role_{{$module->name}}_permission">
                                    <input type="checkbox" name="role[{{$module->name}}][]" id="role_{{$module->name}}_permission" value="permission" 
                                    {{ isRole($roleArr,$module->name,'permission') ? 'checked':false }}
                                />
                                Phân quyền
                                </label>
                            </div>
                        @endif
                    </div>
                </td>
    
            </tr>
        @endforeach
        
    @endif
    </tbody>
    </table>
    <button type="submit">Phân quyền</button>
    @csrf
    </form>