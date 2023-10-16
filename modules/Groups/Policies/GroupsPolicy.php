<?php 

namespace Modules\Groups\Policies;
use App\Models\User;
use Modules\Groups\Models\Groups;


use Illuminate\Auth\Access\HandlesAuthorization;

class GroupsPolicy
{
    use HandlesAuthorization;
 
    public function view(User $user)
    {
         // true: là cho phép
        
        $check = checkPermissions($user,"Groups","view");        
        return $check;
    }
    
    public function create(User $user)
    {
        // true: là cho phép
        $check = checkPermissions($user,"Groups","create");        
        return $check;
    }

    public function update(User $user)
    {
        // true: là cho phép
        $check = checkPermissions($user,"Groups","update");        
        return $check;
    }

    public function delete(User $user)
    {
        // true: là cho phép
        $check = checkPermissions($user,"Groups","delete");        
        return $check;
    }    
    public function permission(User $user)
    {
        // true: là cho phép
        $check = checkPermissions($user,"Groups","permission");        
        return $check;
    }    
}
