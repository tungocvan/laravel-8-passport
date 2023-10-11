<?php
 
namespace Modules\Users\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],                        
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],                        
            'passwordLogin' => ['required', 'string','min:6']
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
            'email' => 'Địa chỉ email',
            'emailLogin' => 'Địa chỉ email',            
            'passwordLogin' => 'Mật khẩu',
        ];
        $request->validate($rules,$message,$attributes);
        
        $username  = Str::beforeLast($request->email, '@');        
        
        $user = [
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'password' => Hash::make($request->password),
            'group_id' => 4,
            'user_id' => 1,
            'provider' =>'website',
            'status' => 1,
            'avatar' => '/images/avatar.jpg'        
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