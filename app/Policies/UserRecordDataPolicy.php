<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserRecordData;
use Illuminate\Auth\Access\Response;

class UserRecordDataPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UserRecordData $userRecordData): Response
    {
        return $user->id === $userRecordData->user_id ? Response::allow() : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserRecordData $userRecordData): Response
    {
        return $user->id === $userRecordData->user_id ? Response::allow() : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserRecordData $userRecordData): Response
    {
        return $user->id === $userRecordData->user_id ? Response::allow() : Response::deny('You do not own this post.');
    }
}
