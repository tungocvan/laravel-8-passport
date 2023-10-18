<?php 

namespace Modules\Post\Policies;
use App\Models\User;
use Modules\Post\Models\Post;


use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;
 
    public function view(User $user)
    {
         // true: là cho phép
        $check = checkPermissions($user,"Post","view");        
        return $check;
    }
    
    public function create(User $user)
    {
        // true: là cho phép
        $check = checkPermissions($user,"Post","create");                
        return $check;
    }

    public function update(User $user)
    {
        // true: là cho phép
        $check = checkPermissions($user,"Post","update");        
        return $check;
    }

    public function delete(User $user)
    {
        // true: là cho phép
        $check = checkPermissions($user,"Post","delete");        
        return $check;
    }    
}
