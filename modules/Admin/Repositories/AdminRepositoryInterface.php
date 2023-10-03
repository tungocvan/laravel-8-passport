<?php
namespace Modules\Admin\Repositories;
use App\Repositories\RepositoryInterface;
interface AdminRepositoryInterface extends RepositoryInterface
{
    public function getAdmin();
}