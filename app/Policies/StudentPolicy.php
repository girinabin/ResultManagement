<?php

namespace App\Policies;

use App\Student;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user){
        return $user->roles()->first()->name=='ADMIN';
    }

    public function show(User $user,Student $student){
        return $student->batch->sclass->user_id==$user->id;
    }


}
