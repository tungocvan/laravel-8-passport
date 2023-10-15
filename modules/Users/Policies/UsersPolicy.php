<?php 

namespace Modules\Users\Policies;
use App\Models\User;
use Modules\Users\Models\Users;


use Illuminate\Auth\Access\HandlesAuthorization;

class UsersPolicy
{
    use HandlesAuthorization;
 
    public function view(User $user)
    {
         // true: là cho phép        
        $check = checkPermissions($user,"Users","view");        
        return $check;
    }
    
    public function create(User $user)
    {
        // true: là cho phép     
        
        $check = checkPermissions($user,"Users","create");        
        return $check;
    }

    public function update(User $user)
    {
        // true: là cho phép
        $check = checkPermissions($user,"Users","update");        
        return $check;
    }

    public function delete(User $user)
    {
        // true: là cho phép
        $check = checkPermissions($user,"Users","delete");        
        return $check;
    }    
}
