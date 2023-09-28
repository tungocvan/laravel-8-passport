<?php
namespace Modules\Sanctum\Observers;
use Modules\Sanctum\Models\Sanctum;
class SanctumObserver
{

    public function creating(Sanctum $data)
    {
        // echo 'creating';
    }
    public function created(Sanctum $data)
    {
        // echo 'created';
    }
}
