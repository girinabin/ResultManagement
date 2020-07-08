<?php

namespace App\Policies;

use App\SchoolClass;
use App\Subject;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
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
    public function create(User $user ){
        
        return $user->roles()->first()->name == 'ADMIN';
    }

    public function editSubject(User $user,Subject $subject){
        
        return $subject->class->user_id ==$user->sclasses()->first()->user_id;
        
    }
    
}
