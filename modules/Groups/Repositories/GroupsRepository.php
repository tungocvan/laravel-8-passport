<?php
namespace Modules\Groups\Repositories;
use App\Repositories\BaseRepository;
use Modules\Groups\Models\Groups;
use Modules\Groups\Repositories\GroupsRepositoryInterface;

class GroupsRepository extends BaseRepository implements GroupsRepositoryInterface
{
    public function getModel()
    {
        return Groups::class;
    }
    public function getGroups()
    {
        return $this->model->all();
    }
}