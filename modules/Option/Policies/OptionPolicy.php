<?php 

namespace Modules\Option\Policies;
use App\Models\User;
use Modules\Option\Models\Option;


use Illuminate\Auth\Access\HandlesAuthorization;

class OptionPolicy
{
    use HandlesAuthorization;
 
    public function view(User $user)
    {
         // true: là cho phép
        $check = checkPermissions($user,"Option","view");        
        return $check;
    }
    
    public function create(User $user)
    {
        // true: là cho phép
        $check = checkPermissions($user,"Option","create");        
        return $check;
    }

    public function update(User $user)
    {
        // true: là cho phép 
        $check = checkPermissions($user,"Option","update");        
        return $check;
    }

    public function delete(User $user)
    {
        // true: là cho phép
        $check = checkPermissions($user,"Option","delete");        
        return $check;
    }    
}
