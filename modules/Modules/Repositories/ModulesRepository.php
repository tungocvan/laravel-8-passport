<?php
namespace Modules\Modules\Repositories;
use App\Repositories\BaseRepository;
use Modules\Modules\Models\Modules;
use Modules\Modules\Repositories\ModulesRepositoryInterface;

class ModulesRepository extends BaseRepository implements ModulesRepositoryInterface
{
    public function getModel()
    {
        return Modules::class;
    }
    public function getModules()
    {
        return $this->model->all();
    }
}