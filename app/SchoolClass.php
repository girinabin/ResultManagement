<?php

namespace App;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $guarded = [];
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
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

    // 
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function batches(){
        return $this->hasMany(Batch::class,'class_id');
    }
    
}
