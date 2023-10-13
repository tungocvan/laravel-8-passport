<?php
 
namespace Modules\Users\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Repositories\UsersRepository;
use Modules\Users\Repositories\UsersRepositoryInterface;


class UsersController extends Controller
{  
    protected $UsersRepo;
    public function __construct(UsersRepositoryInterface $UsersRepo)
    {
       // $this->middleware("auth");       
       $this->UsersRepo = $UsersRepo; 
    }
    public function index()
    {
        //$Users=$this->UsersRepo->getAll();        
        // or user UsersRepository
        $Users = new UsersRepository();    
       //dd($Users->getUsers());
        return getUrlView('users',$Users->getPaginate(5));
    }
    public function add()
    {    
        return getUrlView('users/add');    
    }
    public function postAdd(Request $request)
    {           
        // dd($request->all());
        $rules = [
            'name' => ['required', 'string', 'max:255'],                        
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],                                                       
            'phone' => ['required', 'string', 'max:255', 'unique:users'],                                                       
            'passwordLogin' => ['required', 'string','min:6'],
        ];
        $message  = [
            'required' => ':attribute không được bỏ trống',            
            'unique' => ':attribute đã tồn tại',                              
            'min' => ':attribute không được nhỏ hơn :min ký tự',
            'max' => ':attribute không lớn hơn :max ký tự',
            'confirmed' => ':attribute không khớp',            
            'email' => ':attribute không hợp lệ',            
        ];
        $attributes = [
            'username' => 'Tài khoản',
            'usernameLogin' => 'Tài khoản',
            'name' => 'Họ và tên',
            'phone' => 'Số điện thoại',
            'email' => 'Địa chỉ email',
            'emailLogin' => 'Địa chỉ email',            
            'passwordLogin' => 'Mật khẩu',
        ];
        $request->validate($rules,$message,$attributes);
        
        $username  = Str::beforeLast($request->email, '@');        
        
        $birthday =  Carbon::createFromFormat('d/m/Y', $request->birthday); 
        $avatar = $request->filepath[0] ?? '/images/avatar.jpg';        
        $user = [
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthday' => $birthday,
            'password' => Hash::make($request->password),
            'group_id' => $request->group_id[0],
            'user_id' => 1,
            'provider' =>'website',
            'status' => 1,
            'avatar' => $avatar        
        ];
        
        $this->UsersRepo->create($user);
        return redirect()->route('users.index')->with('msg', "Thêm Tài khoản thành công");    
    }
    public function edit(User $user)
    {                  
        return getUrlView('users/edit',compact('user'));    
    }
    public function postEdit($id,Request $request)
    {           
        //dd($request->all());
        $rules = [
            'name' => ['required', 'string', 'max:255'],                                                         
            'password' => ['required', 'string','min:6']
        ];
        $message  = [
            'required' => ':attribute không được bỏ trống',                                               
            'min' => ':attribute không được nhỏ hơn :min ký tự',                        
            'max' => ':attribute không lớn hơn :max ký tự',
        ];
        $attributes = [            
            'name' => 'Họ và tên',            
            'password' => 'Mật khẩu',
        ];
        $request->validate($rules,$message,$attributes);
        $userUpdate = $request->all();
        
        $user = User::find($id);    

        if($user->password !== $request->password) {
            $userUpdate['password'] = Hash::make($request->password);            
        }else{
            unset($userUpdate['password']);
        }         
        //dd($userUpdate);
        if($userUpdate['phone'] === null) unset($userUpdate['phone']);
        if($userUpdate['birthday'] === null){
            unset($userUpdate['birthday']);
        }else{
            $userUpdate['birthday'] =  Carbon::createFromFormat('d/m/Y', $request->birthday);          
        }     
        $userUpdate['avatar'] = $request->filepath[0];        
        unset($userUpdate['filepath']);        
        $userUpdate['group_id'] = $request->group_id[0];
        if($request->status === 'on'){
            $userUpdate['status'] = 1;
        }else{
            $userUpdate['status'] = 0;
        }
        
        //dd($userUpdate);
        $this->UsersRepo->update($id,$userUpdate);
        
        return redirect()->route('users.index')->with('msg', "Cập nhật Modules thành công");   
    }
    public function postDelete($id)
    {           
        $this->UsersRepo->delete($id);
        return redirect()->route('users.index')->with('msg', "Xóa tài khoản thành công"); ;    
    }
    public function profile()
    {    
        return getUrlView('users/profile');    
    }
    public function permission()
    {    
        return getUrlView('users/permission');    
    }

    
}