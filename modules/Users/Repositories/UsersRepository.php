<?php
namespace Modules\Users\Repositories;
use App\Repositories\BaseRepository;
use App\Models\User;
use Modules\Users\Repositories\UsersRepositoryInterface;

class UsersRepository extends BaseRepository implements UsersRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }
    public function getUsers()
    {
        return $this->model->all();
    }
    public function getPaginate($number)
    {
        return $this->model->paginate($number);
    }
}