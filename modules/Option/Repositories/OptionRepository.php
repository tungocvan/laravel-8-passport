<?php
namespace Modules\Option\Repositories;
use App\Repositories\BaseRepository;
use Modules\Option\Models\Option;
use Modules\Option\Repositories\OptionRepositoryInterface;

class OptionRepository extends BaseRepository implements OptionRepositoryInterface
{
    public function getModel()
    {
        return Option::class;
    }
    public function getOption()
    {
        return $this->model->all();
    }
}