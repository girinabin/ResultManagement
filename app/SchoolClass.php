<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $guarded = [];
    public function school()
    {
        return $this->belongsTo(School::class,'school_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class,'class_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class,'class_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class,'class_id');
    }
    
}
