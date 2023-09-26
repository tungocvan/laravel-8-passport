<?php
namespace Modules\Post\Observers;
use Modules\Post\Models\Post;
class PostObserver
{

    public function creating(Post $data)
    {
        // echo 'creating';
    }
    public function created(Post $data)
    {
        // echo 'created';
    }
}
