<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $guarded =[];
    public function schoolClasses()
    {
        return $this->belongsToMany(SchoolClass::class,'school_school_class');
    }
}
