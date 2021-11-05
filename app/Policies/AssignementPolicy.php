<?php

namespace App\Policies;

use App\Models\Assignement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssignementPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        $headers=apache_request_headers();
        $token=explode(' ',$headers['Authorization']);
        $this->user=User::where('remember_token',$token[1])->first();
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assignement  $assignement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Assignement $assignement)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create()
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assignement  $assignement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update()
    {
        if($this->user->roles_id==3)
            return true;
        else return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assignement  $assignement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete()
    {
        if($this->user->role_id==3)
            return true;
        return false;
    }
}
