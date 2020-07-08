<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $guarded =[];
    public function sclass(){
        return $this->belongsTo(SchoolClass::class,'class_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class,'batch_id');
    }
}
