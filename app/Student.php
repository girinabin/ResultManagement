<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded=[];
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
    public function setFatherNameAttribute($value)
    {
        $this->attributes['father_name'] = strtoupper($value);
    }
    public function sclass()
    {
        return $this->belongsTo(SchoolClass::class,'class_id');
    }

    public function batch(){
        return $this->belongsTo(Batch::class,'batch_id');
    }
}
