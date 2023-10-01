<?php
namespace Modules\Users\Observers;
use Modules\Users\Models\Users;
class UsersObserver
{

    public function creating(Users $data)
    {
        // echo 'creating';
    }
    public function created(Users $data)
    {
        // echo 'created';
    }
}
