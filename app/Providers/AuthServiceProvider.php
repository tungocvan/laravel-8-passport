<?php

namespace App\Providers;

use Modules\Option\Models\Option;
use Modules\Option\Policies\OptionPolicy;


use Modules\Category\Models\Category;
use Modules\Category\Policies\CategoryPolicy;


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
		Option::class => OptionPolicy::class,
		Category::class => CategoryPolicy::class,
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
