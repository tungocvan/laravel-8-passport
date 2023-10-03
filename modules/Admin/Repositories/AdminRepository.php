<?php
namespace Modules\Admin\Repositories;
use App\Repositories\BaseRepository;
use Modules\Admin\Models\Admin;
use Modules\Admin\Repositories\AdminRepositoryInterface;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    public function getModel()
    {
        return Admin::class;
    }
    public function getAdmin()
    {
        return $this->model->all();
    }
}