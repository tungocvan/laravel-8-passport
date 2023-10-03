<?php
namespace Modules\Product\Repositories;
use App\Repositories\BaseRepository;
use Modules\Product\Models\Product;
use Modules\Product\Repositories\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }
    public function getProduct()
    {
        return $this->model->all();
    }
}