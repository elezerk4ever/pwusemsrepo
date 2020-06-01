<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];
    #helper methods 
    public function fullName(){
        return $this->firstname.' '.$this->middlename[0].'. '.$this->lastname;
    }
    public function getGrades($year,$semester){
        return $this->grades()->where(['year'=>$year,'semester'=>$semester,'in_bin'=>0])->get();
    }

    #relation methods
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function program(){
        return $this->belongsTo(Program::class);
    }
    public function grades(){
        return $this->hasMany(Grade::class);
    }
    
}
