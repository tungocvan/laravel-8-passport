<?php
namespace App\Providers;
use Modules\Groups\Models\Groups;
use Modules\Groups\Observers\GroupsObserver;
use Modules\Modules\Models\Modules;
use Modules\Modules\Observers\ModulesObserver;
use Modules\Product\Models\Product;
use Modules\Product\Observers\ProductObserver;
use Modules\Post\Models\Post;
use Modules\Post\Observers\PostObserver;
use Modules\Admin\Models\Admin;
use Modules\Admin\Observers\AdminObserver;
use Modules\Users\Models\Users;
use Modules\Users\Observers\UsersObserver;
use Modules\Upload\Models\Upload;
use Modules\Upload\Observers\UploadObserver;
use Modules\Email\Models\Email;
use Modules\Email\Observers\EmailObserver;
use Modules\Socialite\Models\Socialite;
use Modules\Socialite\Observers\SocialiteObserver;
use Modules\Sanctum\Models\Sanctum;
use Modules\Sanctum\Observers\SanctumObserver;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\UserEventSubscriber;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],   
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [            
            \SocialiteProviders\Zalo\ZaloExtendSocialite::class.'@handle',
        ],
        // "App\Events\UserUpdateEvent" => [
        //     "App\Listeners\UserUpdateListener"
        // ]  
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //observe
		Groups::observe(new GroupsObserver);
		Modules::observe(new ModulesObserver);
		Product::observe(new ProductObserver);
		Post::observe(new PostObserver);
		Admin::observe(new AdminObserver);
		Users::observe(new UsersObserver);
		Upload::observe(new UploadObserver);
		Email::observe(new EmailObserver);
		Socialite::observe(new SocialiteObserver);
		Sanctum::observe(new SanctumObserver);
        
    }

    protected $subscribe = [
        UserEventSubscriber::class,
    ];
}
