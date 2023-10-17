<?php
namespace Modules\Category\Repositories;
use App\Repositories\RepositoryInterface;
interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getCategory();
}