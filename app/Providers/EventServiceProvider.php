<?php
namespace App\Providers;
use Modules\Post\Models\Post;
use Modules\Post\Observers\PostObserver;
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
		Post::observe(new PostObserver);
        User::observe(new UserObserver);        
    }

    protected $subscribe = [
        UserEventSubscriber::class,
    ];
}
