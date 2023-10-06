<?php
namespace Modules\Groups\Repositories;
use App\Repositories\RepositoryInterface;
interface GroupsRepositoryInterface extends RepositoryInterface
{
    public function getGroups();
}