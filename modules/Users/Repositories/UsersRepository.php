<?php
namespace Modules\Users\Repositories;
use App\Repositories\BaseRepository;
use Modules\Users\Models\Users;
use Modules\Users\Repositories\UsersRepositoryInterface;

class UsersRepository extends BaseRepository implements UsersRepositoryInterface
{
    public function getModel()
    {
        return Users::class;
    }
    public function getUsers()
    {
        return $this->model->getAll();
    }
}