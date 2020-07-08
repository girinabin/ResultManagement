<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $guarded =[];
    public function setSchoolNameAttribute($value)
    {
        $this->attributes['school_name'] = strtoupper($value);
    }
    public function setSchoolLocationAttribute($value)
    {
        $this->attributes['school_location'] = strtoupper($value);
    }
    public function setPrincipalAttribute($value)
    {
        $this->attributes['principal'] = strtoupper($value);
    }
    public function classes()
    {
        return $this->hasMany(SchoolClass::class,'school_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
   
}
