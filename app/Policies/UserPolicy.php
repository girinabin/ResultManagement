<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function index(User $user){
        return $user->roles->first()->name =='SUPERADMIN';
    }
    
    public function create(User $user){
        return $user->roles->first()->name =='SUPERADMIN';
    }

   
    public function edit(User $user){
        return $user->roles->first()->name =='SUPERADMIN';
    }
    public function store(User $user){
        return $user->roles->first()->name =='SUPERADMIN';
    }
    public function update(User $user){
        return $user->roles->first()->name =='SUPERADMIN';
    }
    public function destroy(User $user){
        return $user->roles->first()->name =='SUPERADMIN';
    }
}

