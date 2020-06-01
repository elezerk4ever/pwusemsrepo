<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Student;
use \App\User;
use Illuminate\Support\Facades\Hash;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
class StudentsController extends Controller
{
    public function index(){
        $this->authorize('viewAny',Student::class);
        $students = Student::orderBy('firstname','ASC')->paginate(25);
        return view('students.index',compact('students'));
    }
    public function store(Request $request){
        /**
         * users auth pattern 
         * username: student-idnumber
         * password: year-month-date-lastname
         */
        $this->authorize('create',Student::class);
        $data = $this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'middlename'=>'required',
            'gender'=>'required',
            'idnumber'=>'required|unique:students',
            'birthdate'=>'required',
            'program_id'=>'required'
        ]);
        $username = $data['idnumber'];
        $password = explode('-',$data['birthdate']);
        $password = implode('',$password).$data['lastname'];
        $user = User::create([
            'username'=>$username,
            'password'=>Hash::make(strtoupper($password))
        ]);
        $student = $user->student()->create([
            'program_id'=>$data['program_id'],
            'lastname'=>strtoupper($data['lastname']),
            'firstname'=>strtoupper($data['firstname']),
            'middlename'=>strtoupper($data['middlename']),
            'idnumber'=>$data['idnumber'],
            'gender'=>strtoupper($data['gender']),
            'birthdate'=>$data['birthdate'],
        ]);

        return redirect(route('students.show',$student->id))->withSuccess('Success!');
        

    }
    public function update(Request $request,Student $student){
        $this->authorize('update',$student);
        $data = $this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'middlename'=>'required',
            'gender'=>'required',
            'idnumber'=>'required|unique:students',
            'birthdate'=>'required',
            'program_id'=>'required'
        ]);
        $data = [
            'program_id'=>$data['program_id'],
            'lastname'=>strtoupper($data['lastname']),
            'firstname'=>strtoupper($data['firstname']),
            'middlename'=>strtoupper($data['middlename']),
            'idnumber'=>$data['idnumber'],
            'gender'=>strtoupper($data['gender']),
            'birthdate'=>$data['birthdate'],
        ];
        $student->update($data);
        return back()->withSuccess('Done!');
    }
    public function show(Student $student){
        $this->authorize('view',$student);
        return view('students.show',compact('student'));
    }
    public function bin(Student $student){
        $this->authorize('viewAny',Student::class);
        $student->update(['in_bin'=>!$student->in_bin]);
        return back()->withSuccess('Done!');
    }
    public function destroy(Student $student){
        $this->authorize('delete',$student);
        foreach ($student->grades as $grade) {
            $grade->delete();
        }
        $student->user->delete();
        $student->delete();
        return back()->withSuccess('Done!');
    }
    public function destroyAll(){
        $this->authorize('viewAny',Student::class);

        $students = Student::where('in_bin',1)->get();
        foreach ($students as $student) {
            foreach ($student->grades as $grade) {
                $grade->delete();
            }
            $student->user->delete();
            $student->delete();
        }
        return back()->withSuccess('Done!');
    }
    public function export(){
        $this->authorize('viewAny',Student::class);
        return Excel::download(new StudentsExport,'Students_list.xlsx');
    }
}
