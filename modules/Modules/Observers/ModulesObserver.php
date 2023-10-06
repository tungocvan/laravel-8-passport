<?php
namespace Modules\Modules\Observers;
use Modules\Modules\Models\Modules;
class ModulesObserver
{

    public function creating(Modules $data)
    {
        // echo 'creating';
    }
    public function created(Modules $data)
    {
        // echo 'created';
    }
}
