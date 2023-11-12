<?php

namespace App\Policies;

use App\Models\Food;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FoodPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Food $food): Response
    {
        return $user->id === $food->user_id ? Response::allow() : Response::deny('You do not own this post.');
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Food $food): Response
    {
        return $user->id === $food->user_id ? Response::allow() : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Food $food): Response
    {
        return $user->id === $food->user_id ? Response::allow() : Response::deny('You do not own this post.');
    }
}
