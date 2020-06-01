<?php

namespace App\Policies;

use App\Program;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProgramPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->id == 1;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Program  $program
     * @return mixed
     */
    public function view(User $user, Program $program)
    {
        return $user->id == 1;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id == 1;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Program  $program
     * @return mixed
     */
    public function update(User $user, Program $program)
    {
        return $user->id == 1;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Program  $program
     * @return mixed
     */
    public function delete(User $user, Program $program)
    {
        return $user->id == 1;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Program  $program
     * @return mixed
     */
    public function restore(User $user, Program $program)
    {
        return $user->id == 1;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Program  $program
     * @return mixed
     */
    public function forceDelete(User $user, Program $program)
    {
        return $user->id == 1;
    }
}
