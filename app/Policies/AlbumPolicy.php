<?php

namespace App\Policies;

use App\Models\Album;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlbumPolicy
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
        return $user->can('view list: album');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Album $album)
    {
        return $user->can('view details: album');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create album');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Album $album)
    {
        return $user->can('update album');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Album $album)
    {
        return $user->can('delete album');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Album $album)
    {
        return $user->can('restore album');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Album $album)
    {
        //
    }
}
