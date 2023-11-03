<?php
namespace Modules\Option\Observers;
use Modules\Option\Models\Option;
class OptionObserver
{

    public function creating(Option $data)
    {
        // echo 'creating';
    }
    public function created(Option $data)
    {
        // echo 'created';
    }
}
