<?php

namespace App\Policies;

use App\User;
use App\Library;
use Illuminate\Auth\Access\HandlesAuthorization;

class LibraryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can modify the library.
     *
     * @param App\User|User $user
     * @param Library|App\Library $library
     * @return mixed
     */
    public function modify(User $user, Library $library)
    {
        return $user->id === $library->owner->id;
    }

}
