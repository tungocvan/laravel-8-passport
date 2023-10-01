<?php
namespace Modules\Users\Repositories;
use App\Repositories\RepositoryInterface;
interface UsersRepositoryInterface extends RepositoryInterface
{
    public function getUsers();
}