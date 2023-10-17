<?php 

namespace Modules\Category\Policies;
use App\Models\User;
use Modules\Category\Models\Category;


use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;
 
    public function view(User $user)
    {
         // true: là cho phép
        $check = checkPermissions($user,"Category","view");        
        return $check;
    }
    
    public function create(User $user)
    {
        // true: là cho phép
        $check = checkPermissions($user,"Category","create");        
        return $check;
    }

    public function update(User $user)
    {
        // true: là cho phép 
        $check = checkPermissions($user,"Category","update");        
        return $check;
    }

    public function delete(User $user)
    {
        // true: là cho phép
        $check = checkPermissions($user,"Category","delete");        
        return $check;
    }    
}
