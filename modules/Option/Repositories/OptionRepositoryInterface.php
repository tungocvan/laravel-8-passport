<?php
namespace Modules\Option\Repositories;
use App\Repositories\RepositoryInterface;
interface OptionRepositoryInterface extends RepositoryInterface
{
    public function getOption();
}