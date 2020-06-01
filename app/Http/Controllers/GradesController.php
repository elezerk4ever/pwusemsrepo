<?php

namespace App\Http\Controllers;
use App\Imports\GradesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use \App\Student;
class GradesController extends Controller
{
    public function index(){
        $this->authorize('viewAny',\App\Grade::class);
        return view('grades.index');
    }
    public function store(Request $request, Student $student){
        $this->authorize('create',\App\Grade::class);
        $data = $this->validate($request,
        [
            'year'=>'required',
            'semester'=>'required',
            'code'=>'required',
            'description'=>'required',
            'unit'=>'required',
            'is_ojt'=>'',
            'grade'=>'required'
        ]);
        $data['year'] = strtoupper($data['year']);
        $data['semester'] = strtoupper($data['semester']);
        $data['code'] = strtoupper($data['code']);
        $data['description'] = strtoupper($data['description']);
        $student->grades()->create($data);
        return back()->withSuccess('Added successfully!');
    }
    public function import(Request $request){
        $this->authorize('create',\App\Grade::class);
        $this->validate($request,[
            'year'=>'required',
            'semester'=>'required',
            'code'=>'required',
            'description'=>'required',
            'unit'=>'required',
            'is_ojt'=>'',
            'file'=>'required|mimes:xlsx'
        ]);
        Excel::import(new GradesImport($request->year,$request->semester,$request->code,$request->description,$request->unit,$request->is_ojt), $request->file('file'));
        return back()->withSuccess('Done!');
    }
    public function bin(\App\Grade $grade){
        $this->authorize('viewAny',\App\Grade::class);
        $grade->update(['in_bin'=>!$grade->in_bin]);
        return back()->withSuccess('Done!');
    }
    public function destroy(\App\Grade $grade){
        $this->authorize('delete',$grade);
        $grade->delete();
        return back()->withSuccess('Done!');
    }
    public function destroyAll(){
        $this->authorize('viewAny',\App\Grade::class);
        $grades = \App\Grade::where('in_bin',1)->get();
        foreach ($grades as $grade) {
            $grade->delete();
        }
        return back()->withSuccess('Done!');
    }
}
