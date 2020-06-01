@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Table of Students
            </div>
            <div class="card-body">
                <table class="w-100 table-bordered d-print-table">
                    <tr class="bg-light">
                        <th class="d-print-none"></th>
                        <th>
                            ID No.
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Course/Curriculum
                        </th>
                        <th>
                            Gender
                        </th>
                        <th>
                            Birthdate
                        </th>
                    </tr>
                    @forelse (\App\Student::latest()->where('in_bin',0)->get() as $student)
                        <tr>
                           <td class="d-print-none">
                               <a href="{{route('students.bin',$student)}}">
                                   <i class="fa fa-trash text-danger"></i>
                               </a>
                           </td>
                            <td class="text-center">
                                {{$student->idnumber}}
                            </td>
                            <td class="text-center">
                                <a href="{{route('students.show',$student->id)}}">{{$student->fullname()}}</a>
                            </td>
                            <td class="text-center">
                                {{$student->program->name}}
                            </td>
                            <td class="text-center">
                                {{$student->gender}}
                            </td>
                            <td class="text-center">
                                {{$student->birthdate}}
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-warning" role="alert">
                            No Student to Show
                        </div>
                    @endforelse
                </table>
                {{$students->links()}}
               
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Input Student
            </div>
            <div class="card-body">
            <form action="{{route('students.store')}}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="idnumber">Student number</label>
                        <input id="idnumber" class="form-control" type="text" name="idnumber"required>
                        <small class="form-text text-muted">Ex. 18001487000</small>
                    </div>
                    <div class="form-group">
                        <label for="firstname">FirstName</label>
                        <input id="firstname" class="form-control" type="text" name="firstname"required>
                        <small class="form-text text-muted">Ex. Juan</small>
                    </div>
                    <div class="form-group">
                        <label for="middlename"> Middlename</label>
                        <input id="middlename" class="form-control" type="text" name="middlename"required>
                        <small class="form-text text-muted">Ex. Marcos</small>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input id="lastname" class="form-control" type="text" name="lastname"required>
                        <small class="form-text text-muted">Ex. Dela Cruz</small>
                    </div>
                    <div class="form-group">
                        <label for="program_id">Course/program</label>
                        <select id="program_id" class="form-control" name="program_id" required>
                            <option value="" disabled selected>Select Course</option>
                            @forelse (\App\Program::where('in_bin',false)->get() as $program)
                        <option value="{{$program->id}}">
                            {{$program->name}}
                        </option>
                            @empty
                                <option value="#" disabled>Please Add Program first !</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" class="form-control" name="gender">
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Birthdate</label>
                        <input id="birthdate" class="form-control" type="date" name="birthdate" required>
                    </div>      
                    <button class="btn btn-block btn-primary">
                        Add Student
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection