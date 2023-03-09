<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Notifications\DatabaseNotification;

class NotificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Notifications\DatabaseNotification  $databaseNotification
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, DatabaseNotification $databaseNotification)
    {
        return $user->id == $databaseNotification->notifiable_id;
    }
}
