<?php

namespace App\Policies;

use App\Models\Diary;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DiaryPolicy
{


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Diary $diary): Response
    {
        return $user->id === $diary->user_id ? Response::allow() : Response::deny('You do not own this post.');
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Diary $diary): Response
    {
        return $user->id === $diary->user_id ? Response::allow() : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Diary $diary): Response
    {
        return $user->id === $diary->user_id ? Response::allow() : Response::deny('You do not own this post.');
    }
}
