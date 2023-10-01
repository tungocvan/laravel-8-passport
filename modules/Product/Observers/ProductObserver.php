<?php
namespace Modules\Product\Observers;
use Modules\Product\Models\Product;
class ProductObserver
{

    public function creating(Product $data)
    {
        // echo 'creating';
    }
    public function created(Product $data)
    {
        // echo 'created';
    }
}
