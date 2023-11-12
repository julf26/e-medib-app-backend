<?php

namespace App\Policies;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ActivityPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Activity $activity): Response
    {
        return $user->id === $activity->user_id ? Response::allow() : Response::deny('You do not own this post.');
    }



    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Activity $activity): Response
    {
        return $user->id === $activity->user_id ? Response::allow() : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Activity $activity): Response
    {
        return $user->id === $activity->user_id ? Response::allow() : Response::deny('You do not own this post.');
    }}
