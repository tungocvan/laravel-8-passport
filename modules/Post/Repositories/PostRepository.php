<?php
namespace Modules\Post\Repositories;
use App\Repositories\BaseRepository;
use Modules\Post\Models\Post;
use Modules\Post\Repositories\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function getModel()
    {
        return Post::class;
    }
    public function getPost()
    {
        return $this->model->all();
    }
    public function getPaginate($number)
    {
        return $this->model->paginate($number);
    }
} 