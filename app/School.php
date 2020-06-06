<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $guarded =[];

    public function classes()
    {
        return $this->hasMany(SchoolClass::class,'school_id');
    }
   
}
