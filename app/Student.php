<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded=[];
    public function sclass()
    {
        return $this->belongsTo(SchoolClass::class,'class_id');
    }

}
