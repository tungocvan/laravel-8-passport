<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        //
        //echo 'creating -UserObserver';
        //file_put_contents(base_path().'/logs.txt',$user->email);
        
        
    }
    public function created(User $user)
    {
        //
        //echo 'created-UserObserver ';
        //file_put_contents(base_path().'/logs.txt',$user->email.'-'.'created');
        
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
        //echo 'updated-UserObserver';
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
        // echo 'deleted-UserObserver';
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
        // echo 'restored-UserObserver';
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
        // echo 'forceDeleted-UserObserver';
    }
}
