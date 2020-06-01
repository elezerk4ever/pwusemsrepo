<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Program;

class ProgramsController extends Controller
{
    public function index(){
        $this->authorize('viewAny',Program::class);
        $programs = Program::where('in_bin',0)->get();
        return view('programs.index',compact('programs'));
    }
    public function store(Request $request){
        $data = $this->validate($request,[
            'name'=>'required',
            'term'=>'required',
            'file'=>'required',
            'description'=>'required'
        ]);
        $path = $request->file('file')->store('public/curricula');
        $path = explode('/',$path);
        $path[0] = 'storage';
        $path = implode('/',$path);
        Program::create([
            'name'=>strtoupper($data['name']),
            'term'=>$data['term'],
            'file'=>$path,
            'description'=>strtoupper($data['description'])
        ]);
        return back()->withSuccess('created Succesfully!');
    }
    public function show(Program $program){
        $this->authorize('view',$program);
        return view('programs.show',compact('program'));
    }
    public function update(Request $request, Program $program){
        $this->authorize('update',$program);
        $data = $this->validate($request,[
            'name'=>'required',
            'term'=>'required',
            'file'=>'required',
            'description'=>'required'
        ]);
        // dd($request->all());
        $oldpath = explode('/',$program->file);
        $oldpath[0] = 'public';
        $oldpath = implode('/',$oldpath);
        Storage::delete($oldpath);
        $path = $request->file('file')->store('public/curricula');
        $path = explode('/',$path);
        $path[0] = 'storage';
        $path = implode('/',$path);
        $program->update([
            'name'=>strtoupper($data['name']),
            'term'=>$data['term'],
            'file'=>$path,
            'description'=>strtoupper($data['description'])
        ]);
        return back()->withSuccess('updated Succesfully!');
    }

    public function bin(Program $program){
        $this->authorize('view',$program);
        $program->update(['in_bin'=>!$program->in_bin]);
        return back()->withSuccess('Done!');
    }

    public function destroy(Program $program){
        $this->authorize('delete',$program);
        foreach ($program->students as $student) {
            foreach($student->grades as $grade){
                $grade->delete();
            }
            $student->user->delete();
            $student->delete();
        }
        $path = explode('/',$program->file);
        $path[0] = 'public';
        $path = implode('/',$path);
        Storage::delete($path);
        $program->delete();
        return back()->withSuccess('Done!');
    }

    public function destroyAll(){
        $this->authorize('viewAny',Program::class);
        $programs = Program::where('in_bin',1)->get();
        foreach ($programs as $program) {
            foreach ($program->students as $student) {
                foreach($student->grades as $grade){
                    $grade->delete();
                }
                $student->user->delete();
                $student->delete();
            }
            $path = explode('/',$program->file);
            $path[0] = 'public';
            $path = implode('/',$path);
            Storage::delete($path);
            $program->delete();
        }
        return back()->withSuccess('Done!');
    }
}
