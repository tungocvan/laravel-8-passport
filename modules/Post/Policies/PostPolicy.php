<?php 

namespace Modules\Post\Policies;
use App\Models\User;
use Modules\Post\Models\Post;


use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user)
    {
        // true: là cho phép
        $check = checkPermissions($user,"post","view");        
        return $check;
    }


    public function view(User $user, Post $post)
    {
        $check = checkPermissions($user,"post","view");        
        return $check;
    }
    
    public function create(User $user)
    {
        $check = checkPermissions($user,"post","add");        
        return $check;
    }

    public function update(User $user, Post $post)
    {
        $check = checkPermissions($user,"post","update");        
        return $check;
    }

    public function delete(User $user, Post $post)
    {
        $check = checkPermissions($user,"post","delete");        
        return $check;
    }

    public function restore(User $user, Post $post)
    {
        // true: là cho phép
        return true;
    }

    public function forceDelete(User $user, Post $post)
    {
       // true: là cho phép
        return true;
    }
}
