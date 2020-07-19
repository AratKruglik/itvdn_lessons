<?php

namespace App\Policies;

use App\User;
use App\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can restore the product.
     *
     * @param  User  $user
     * @param  Product  $product
     * @return mixed
     */
    public function restore(User $user, Product $product): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the product.
     *
     * @param  User  $user
     * @param  Product  $product
     * @return mixed
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return $user->is_admin;
    }
}
