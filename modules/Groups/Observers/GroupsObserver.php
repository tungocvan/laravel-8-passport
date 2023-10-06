<?php
namespace Modules\Groups\Observers;
use Modules\Groups\Models\Groups;
class GroupsObserver
{

    public function creating(Groups $data)
    {
        // echo 'creating';
    }
    public function created(Groups $data)
    {
        // echo 'created';
    }
}
