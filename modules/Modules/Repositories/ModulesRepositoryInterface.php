<?php
namespace Modules\Modules\Repositories;
use App\Repositories\RepositoryInterface;
interface ModulesRepositoryInterface extends RepositoryInterface
{
    public function getModules();
}