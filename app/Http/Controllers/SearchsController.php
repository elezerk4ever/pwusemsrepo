<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Student;
class SearchsController extends Controller
{
    public function index(){
        $keyword = request('keyword');
        if(empty($keyword)) return back();
        $students = Student::where('idnumber','Like','%'.$keyword.'%')->orWhere('firstname','LIKE','%'.$keyword.'%')->orWhere('lastname','LIKE','%'.$keyword.'%')->orWhere('middlename','LIKE','%'.$keyword.'%')->get();
        return view('searchs.index',compact('students','keyword'));
    }
}
