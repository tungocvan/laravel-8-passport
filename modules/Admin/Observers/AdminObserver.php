<?php
namespace Modules\Admin\Observers;
use Modules\Admin\Models\Admin;
class AdminObserver
{

    public function creating(Admin $data)
    {
        // echo 'creating';
    }
    public function created(Admin $data)
    {
        // echo 'created';
    }
}
