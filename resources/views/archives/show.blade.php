@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($var == 'programs')
            
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Record of Programs - {{$date}}
                </div>
                <div class="card-body">
                    <table class="w-100 table-bordered d-print-table">
                        <tr class="bg-light">
                            
                            <th>
        
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                Term #
                            </th>
                            <th>
                                Curriculum
                            </th>
                        </tr>
                        @forelse ($archive as $arch)
                            <tr>
                               
                                <td class="text-center">
                                <a href="{{route('programs.bin',$arch['id'])}}" title="move to trash"><i class="fa fa-trash{{$arch['in_bin'] ? '-restore text-success':' text-danger'}} "></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('programs.show',$arch['id'])}}">{{$arch['name']}}</a>
                                </td>
                                <td class="text-center">
                                    {{$arch['description']}}
                                </td>
                                <td class="text-center">
                                    {{$arch['term']}}
                                </td>
                                <td class="text-center">
                                <a href="/{{$arch['file']}}" download="{{$arch['name'].'_curriculum'}}" title="download"><i class="fa fa-download text-success"></i></a>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-warning" role="alert">
                                No Program to Show
                            </div>
                        @endforelse
                    </table>
                    
                   
                </div>
            </div>
            @elseif($var == 'students')
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Record of Students
                </div>
                <div class="card-body">
                    <table class="w-100 table-bordered d-print-table">
                        <tr class="bg-light">
                            
                            <th>
                                ID No.
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Gender
                            </th>
                            <th>
                                Birthdate
                            </th>
                        </tr>
                        @forelse ($archive as $arch)
                            <tr>
                               
                                <td class="text-center">
                                    {{$arch['idnumber']}}
                                </td>
                                <td class="text-center">
                                    <a href="{{route('students.show',$arch['id'])}}">{{$arch['firstname'].' '.$arch['middlename'].'. '.$arch['lastname']}}</a>
                                </td>
                                <td class="text-center">
                                    {{$arch['gender']}}
                                </td>
                                <td class="text-center">
                                    {{$arch['birthdate']}}
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-warning" role="alert">
                                No Student to Show
                            </div>
                        @endforelse
                    </table>
                    
                   
                </div>
            </div>
            @elseif($var == 'grades')
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Record of Grades
                    </div>
                    <div class="card-body">
                        <table class="table-bordered d-print-table w-100">
                            <tr>
                                <th>
                                    Subject Code
                                </th>
                                <th>
                                    Subject Desription
                                </th>
                                <th>
                                    Grade
                                </th>
                                <th>
                                    Owner
                                </th>
                            </tr>
                            @foreach ($archive as $arch)
                                <tr>
                                    <td>
                                        {{$arch['code']}}
                                    </td>
                                    <td>
                                        {{$arch['description']}}
                                    </td>
                                    <td>
                                        {{$arch['grade']}}
                                    </td>
                                    <td>
                                        @php
                                            $student = \App\Student::find($arch['student_id']);
                                        @endphp
                                        <a href="{{route('students.show',$student->id)}}">{{$student->fullname()}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection