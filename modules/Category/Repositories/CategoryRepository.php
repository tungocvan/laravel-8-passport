<?php
namespace Modules\Category\Repositories;
use App\Repositories\BaseRepository;
use Modules\Category\Models\Category;
use Modules\Category\Repositories\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }
    public function getCategory()
    {
        return $this->model->all();
    }
}