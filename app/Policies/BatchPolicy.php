<?php

namespace App\Policies;

use App\Batch;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BatchPolicy
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

    public function addBatch(User $user){
        return $user->roles()->first()->name == 'ADMIN';
    }
    public function updateBatch(User $user,Batch $batch){
        return $user->id==$batch->sclass->user_id;
    }

    // student model
    public function batchStudent(User $user,Batch $batch){
        return $batch->sclass->user_id==$user->id;
    }


}
