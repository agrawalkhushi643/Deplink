<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Package;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create packages.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true; // Any logged in user.
    }

    /**
     * Determine whether the user can update the package.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Package  $package
     * @return mixed
     */
    public function update(User $user, Package $package)
    {
        return $user->getKey() === $package->owner_id;
    }

    /**
     * Determine whether the user can delete the package.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Package  $package
     * @return mixed
     */
    public function delete(User $user, Package $package)
    {
        return $user->getKey() === $package->owner_id;
    }
}
