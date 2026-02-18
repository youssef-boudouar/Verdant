<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Determine if user can view any products
     */
    public function viewAny(User $user)
    {
        return $user->can('view products');
    }

    /**
     * Determine if user can view a specific product
     */
    public function view(User $user, Product $product)
    {
        return $user->can('view products');
    }

    /**
     * Determine if user can create products
     */
    public function create(User $user)
    {
        return $user->can('create products');
    }

    /**
     * Determine if user can update a product
     */
    public function update(User $user, Product $product)
    {
        return $user->can('edit products');
    }

    /**
     * Determine if user can delete a product
     */
    public function delete(User $user, Product $product)
    {
        return $user->can('delete products');
    }
}
