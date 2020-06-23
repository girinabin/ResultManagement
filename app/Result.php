<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $guarded=[];
    protected $casts = [

        'studentresults' => 'array'
    ];
    public function class()
    {
        return $this->belongsTo(SchoolClass::class,'class_id');
    }

}
