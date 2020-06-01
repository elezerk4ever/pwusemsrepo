@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <h5 class="text-center">
                Programs
            </h5>
            <ul class="list-group">
                @foreach ($programs as $key=>$program)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{route('archives.show',['programs',$key])}}">{{$key}} </a>
                        <span class="badge badge-primary badge-pill">
                            {{count($program)}}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-4">
            <h5 class="text-center">
                Students
            </h5>
            <ul class=" list-group">
                @foreach ($students as $key=>$student)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{route('archives.show',['students',$key])}}">{{$key}}</a>
                        <span class="badge badge-primary badge-pill">
                            {{count($student)}}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-4">
            <h5 class="text-center">
                Grades
            </h5>
            <ul class="list-group">
                @foreach ($grades as $key=>$grade)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{route('archives.show',['grades',$key])}}">{{$key}}</a>
                        <span class="badge badge-primary badge-pill">
                            {{count($grade)}}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection