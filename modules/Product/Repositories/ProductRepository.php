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
    public function getPaginate($number)
    {
        return $this->model->where('post_type','product')->paginate($number);
    }
}