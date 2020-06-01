<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchivesController extends Controller
{
    public function index(){
        $this->authorize('viewAny',\App\Program::class);
        $programs = \App\Program::latest()->get()->groupBy(function($item){ return $item->created_at->format('M-Y');})->toArray();
        $students = \App\Student::latest()->get()->groupBy(function($item){ return $item->created_at->format('M-Y');})->toArray();
        $grades = \App\Grade::latest()->get()->groupBy(function($item){ return $item->created_at->format('M-Y');})->toArray();
        return view('archives.index',compact('programs','grades','students'));
    }
    public function show($var,$date){
        $this->authorize('viewAny',\App\Program::class);
        $archive = null;
        if($var == 'programs'){
            $programs = \App\Program::latest()->get()->groupBy(function($item){ return $item->created_at->format('M-Y');})->toArray();
            foreach ($programs as $key => $value) {
                if($key == $date){
                    $archive = $value;
                }
            }
            
        }else if($var == 'students'){
            $students = \App\Student::latest()->get()->groupBy(function($item){ return $item->created_at->format('M-Y');})->toArray();
            foreach ($students as $key => $value) {
                if($key == $date){
                    $archive = $value;
                }
            }
            
        }
        else if($var == 'grades'){
            $grades = \App\Grade::latest()->get()->groupBy(function($item){ return $item->created_at->format('M-Y');})->toArray();
            foreach ($grades as $key => $value) {
                if($key == $date){
                    $archive = $value;
                }
            }
            
        }
        return view('archives.show',compact('archive','var','date'));
    }
}
