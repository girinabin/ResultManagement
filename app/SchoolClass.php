<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $guarded = [];
    public function schools()
    {
        return $this->belongsToMany(School::class,'school_school_class');
    }
}
