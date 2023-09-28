<?php
namespace Modules\Socialite\Observers;
use Modules\Socialite\Models\Socialite;
class SocialiteObserver
{

    public function creating(Socialite $data)
    {
        // echo 'creating';
    }
    public function created(Socialite $data)
    {
        // echo 'created';
    }
}
