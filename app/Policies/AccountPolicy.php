<?php

namespace App\Policies;

use App\User;
use App\Models\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the account.
     *
     * @param  \App\User  $user
     * @param  \App\Account  $account
     * @return mixed
     */
    public function view(User $user, Account $account)
    {
        return $user->id === $account->user_id;
    }

    /**
     * Determine whether the user can create accounts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id === $account->user_id;
    }

    /**
     * Determine whether the user can update the account.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Account  $account
     * @return mixed
     */
    public function update(User $user, Account $account)
    {
      return $user->id === $account->user_id;
    }

    /**
     * Determine whether the user can delete the account.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Account  $account
     * @return mixed
     */
    public function delete(User $user, Account $account)
    {
      die;
        return $user->id === $account->user_id;
    }
}
