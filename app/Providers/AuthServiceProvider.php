<?php

namespace App\Providers;

use Modules\Users\Models\Users;
use Modules\Users\Policies\UsersPolicy;


use Modules\Groups\Models\Groups;
use Modules\Groups\Policies\GroupsPolicy;


use Modules\Post\Models\Post;
use Modules\Post\Policies\PostPolicy;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
		Users::class => UsersPolicy::class,
		Groups::class => GroupsPolicy::class,
		Post::class => PostPolicy::class,
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
        if (! $this->app->routesAreCached()) {
            Passport::routes();
        }
    }
}
