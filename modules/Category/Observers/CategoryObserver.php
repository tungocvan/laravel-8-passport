<?php
namespace Modules\Category\Observers;
use Modules\Category\Models\Category;
class CategoryObserver
{

    public function creating(Category $data)
    {
        // echo 'creating';
    }
    public function created(Category $data)
    {
        // echo 'created';
    }
}
