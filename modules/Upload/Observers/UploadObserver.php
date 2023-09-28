<?php
namespace Modules\Upload\Observers;
use Modules\Upload\Models\Upload;
class UploadObserver
{

    public function creating(Upload $data)
    {
        // echo 'creating';
    }
    public function created(Upload $data)
    {
        // echo 'created';
    }
}
