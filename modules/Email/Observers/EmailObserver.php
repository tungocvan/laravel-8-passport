<?php
namespace Modules\Email\Observers;
use Modules\Email\Models\Email;
class EmailObserver
{

    public function creating(Email $data)
    {
        // echo 'creating';
    }
    public function created(Email $data)
    {
        // echo 'created';
    }
}
