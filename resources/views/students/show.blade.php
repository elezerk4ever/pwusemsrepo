@extends('layouts.app')
@section('content')
    
<div class="row justify-content-center">
    <div class="col">
        <h2 class="d-flex justify-content-between">
            {{$student->fullname()}}
            @can('viewAny', \App\Student::class)
            <a href="{{route('students.bin',$student->id)}}" class="d-print-none" title="move to trash"><i class="fa fa-trash{{$student->in_bin ? '-restore text-success':' text-danger'}} "></i></a>
            @endcan
        </h2>
        <div class="d-flex justify-content-between">
            <div class="p-1">
                <strong>Student No. </strong> {{$student->idnumber}}
                <br>
                <strong>Course/Program </strong> {{$student->program->name}}
                <br>
                @can('viewAny', \App\Program::class)
                <strong class="d-print-none">Curriculum </strong> <a href="{{$student->program->filePath()}}" class="d-print-none"><i class="fa fa-download"></i> Download file</a>
                @endcan
            </div>
            <div class="p-1">
                <strong>Birthdate</strong> {{$student->birthdate}}
                <br>
                <strong>Gender </strong><i class="{{$student->gender == "MALE" ? 'fa fa-mars':'fa fa-venus'}}"></i>  {{$student->gender}} 
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between align-items-baseline">
            <h4>
                Grades
            </h4>
            
            <button class="btn btn-primary btn-sm d-print-none" data-toggle="modal" data-target="#addgrade"><i class="fa fa-plus"></i> Grade</button>
        </div>
        <div class="d-flex my-2 d-print-none">
            <a href="{{route('students.show',$student->id)}}" class="btn btn-sm btn-outline-primary mr-2">All</a>
            <a href="{{route('students.show',$student->id)}}?year=first" class="btn btn-sm btn-outline-primary mr-2">First Year</a>
            <a href="{{route('students.show',$student->id)}}?year=second" class="btn btn-sm btn-outline-primary mr-2">Second Year</a>
            <a href="{{route('students.show',$student->id)}}?year=third" class="btn btn-sm btn-outline-primary mr-2">Third Year</a>
            <a href="{{route('students.show',$student->id)}}?year=fourth" class="btn btn-sm btn-outline-primary mr-2">Fourth Year</a>
        </div>
        <div>
            <h5 class="text-center">
                {{isset($_GET['year'])  ? strtoupper($_GET['year']).' YEAR':'OVERALL'}}
            </h5>
        </div>
        @if ($student->grades->count() == 0)
            <div class="alert alert-warning">No grade to shows</div>

        @else
            @php
                $sems = ['FIRST','SECOND','SUMMER']
            @endphp
            @if (isset($_GET['year']))
            
                @foreach ($sems as $sem)
                <table class="d-print-table w-100 table-bordered table-striped mb-2">
                    <tr>
                        <th colspan="7" class="bg-primary text-white">
                            {{$sem}}
                        </th>
                    </tr>
                    <tr>
                        <th class="d-print-none">
                            
                        </th>
                        <th>
                            code
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Unit
                        </th>
                        <th>
                            Mark
                        </th>
                    </tr>
                    @foreach ($student->getGrades($_GET['year'],$sem) as $grade)
                    <tr>
                        <td class="d-print-none">
                        <a href="{{route('grades.bin',$grade->id)}}"><i class="fa fa-trash text-danger"></i></a>
                        </td>
                        <td>
                            {{$grade->code}}
                        </td>
                        <td>
                            {{$grade->description}}
                        </td>
                        <td>
                            {{$grade->unit}}
                        </td>
                        <td>
                            {{$grade->grade}}
                        </td>
                    </tr>
                @endforeach
            </table>

                @endforeach
                
            @else
                <table class="w-100 table-bordered d-print-table">
                    <tr>
                        <th class="d-print-none">
                            
                        </th>
                        <th>
                            code
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Unit
                        </th>
                        <th>
                            Mark
                        </th>
                    </tr>
                    @foreach ($student->grades()->where('in_bin',0)->get() as $grade)
                        <tr>
                            <td class="d-print-none">
                                <a href="{{route('grades.bin',$grade->id)}}"><i class="fa fa-trash text-danger"></i></a>
                            </td>
                            <td>
                                {{$grade->code}}
                            </td>
                            <td>
                                {{$grade->description}}
                            </td>
                            <td>
                                {{$grade->unit}}
                            </td>
                            <td>
                                {{$grade->grade}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        @endif
        <!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addgrade">
    Launch demo modal
  </button> --}}
  
  <!-- Modal -->
  <div class="modal fade" id="addgrade" tabindex="-1" role="dialog" aria-labelledby="addgradeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addgradeLabel">Grade info</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route('grades.store',$student->id)}}">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="year">Year</label>
                    <select id="year" class="form-control" name="year" required>
                        <option disabled selected>Select Year</option>
                        <option value="first">First Year</option>
                        <option value="second">Second Year</option>
                        <option value="third">Third Year</option>
                        <option value="fourth">Fourth Year</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select id="semester" class="form-control" name="semester" required>
                        <option disabled selected>Select semester</option>
                        <option value="first">First semester</option>
                        <option value="second">Second semester</option>
                        <option value="summer">Summer</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="code">Subject code</label>
                    <input id="code" class="form-control" type="text" name="code" required>
                    <small class="form-text text-muted">Ex. IT2314</small>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input id="description" class="form-control" type="text" name="description">
                    <small class="form-text text-muted">Ex. Introduction to computer networks</small>
                </div>
                <div class="form-group">
                    <label for="unit">Unit</label>
                    <input id="unit" class="form-control" type="number" name="unit">
                </div>
                <div class="form-check">
                    <input id="is_ojt" class="form-check-input" type="checkbox" name="is_ojt" value="1" >
                    <label for="is_ojt" class="form-check-label">Check if it is OJT</label>
                </div>
                <div class="form-group">
                    <label for="grade">Grade Value</label>
                    <input id="grade" class="form-control" type="text" name="grade">
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    Submit grade
                </button>
            </form>
        </div>
      </div>
    </div>
  </div>
    </div>
    @can('viewAny', \App\Student::class)
        
    <div class="col-md-3 d-print-none">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Edit student
            </div>
            <div class="card-body">
                <form action="{{route('students.update',$student->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="idnumber">Student number</label>
                            <input id="idnumber" class="form-control" type="text" value="{{$student->idnumber}}"name="idnumber"required>
                            <small class="form-text text-muted">Ex. 18001487000</small>
                        </div>
                        <div class="form-group">
                            <label for="firstname">FirstName</label>
                            <input id="firstname" value="{{$student->firstname}}" class="form-control" type="text" name="firstname"required>
                            <small class="form-text text-muted">Ex. Juan</small>
                        </div>
                        <div class="form-group">
                            <label for="middlename"> Middlename</label>
                            <input id="middlename" class="form-control" value="{{$student->middlename}}"e="text" name="middlename"required>
                            <small class="form-text text-muted">Ex. Marcos</small>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input id="lastname" class="form-control" type="text" value="{{$student->lastname}}" name="lastname"required>
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
                            <input id="birthdate" class="form-control" type="date" name="birthdate" value="{{$student->birthdate}}" required>
                        </div>      
                        <button class="btn btn-block btn-primary">
                            Update Student
                        </button>
                    </form>
            </div>
        </div>
    </div>
    @endcan
</div>

@endsection