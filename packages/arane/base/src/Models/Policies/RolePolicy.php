<?php

namespace Arane\Base\Models\Policies;

use Arane\Base\Models\Entities\User;
use Arane\Base\Models\Entities\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy {
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view the model.
     *
     * @param  User $user
     * @param  Role $model
     * @return mixed
     */
    public function view(User $user, Role $model) {
        return $user->isAdmin() || $user->hasPermission('read-roles');
    }
    
    /**
     * Determine whether the user can create models.
     *
     * @param  User $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->isAdmin() || $user->hasPermission('write-roles');
    }
    
    /**
     * Determine whether the user can update the model.
     *
     * @param  User $user
     * @param  Role $model
     * @return mixed
     */
    public function update(User $user, Role $model) {
        return $user->isAdmin() || $user->hasPermission('write-roles');
    }
    
    /**
     * Determine whether the user can delete the model.
     *
     * @param  User $user
     * @param  Role $model
     * @return mixed
     */
    public function delete(User $user, Role $model) {
        return ($user->isAdmin() || $user->hasPermission('delete-roles'));
    }
    
    /**
     * Determine whether the user can restore the model.
     *
     * @param  User $user
     * @param  Role $model
     * @return mixed
     */
    public function restore(User $user, Role $model) {
        return $user->isAdmin() || $user->hasPermission('delete-roles');
    }
    
    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User $user
     * @param  Role $model
     * @return mixed
     */
    public function forceDelete(User $user, Role $model) {
        return ($user->isAdmin() || $user->hasPermission('delete-roles'));
    }
}
