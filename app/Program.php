<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $guarded = [];

    public function filePath(){
        return url($this->file);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }
    
}
