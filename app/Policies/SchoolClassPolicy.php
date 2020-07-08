<?php

namespace App\Policies;

use App\SchoolClass;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolClassPolicy
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

    public function createClass(User $user){
        return $user->roles()->first()->name=='ADMIN';
        
    }
    public function addClass(User $user){
        return $user->roles()->first()->name=='ADMIN';
        
    }

    public function indexClass(User $user){
        $classes = $user->sclasses;
        if($classes->isEmpty()){
            return true;
        }
        foreach($classes as $class){
            return $class->user_id == $user->id;
        }
    }

    public function updateClass(User $user ,SchoolClass $class){
        return $user->id == $class->user_id;
    }
    public function deleteClass(User $user ,SchoolClass $class){
        return $user->id == $class->user_id;
    }


    // subject policy
    // batch policy

    public function creates(User $user,SchoolClass $class ){
        
        return $user->id == $class->user_id;
        
    }
}
