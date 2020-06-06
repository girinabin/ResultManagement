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
    
}
