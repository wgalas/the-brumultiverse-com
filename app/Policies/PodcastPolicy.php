<?php

namespace App\Policies;

use App\Models\Podcast;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PodcastPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view list: podcast');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Podcast $podcast)
    {
        return $user->can('view details: podcast');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create podcast');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Podcast $podcast)
    {
        return $user->can('update podcast');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Podcast $podcast)
    {
        return $user->can('delete podcast');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Podcast $podcast)
    {
        return $user->can('restore podcast');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Podcast  $podcast
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Podcast $podcast)
    {
        //
    }
}
