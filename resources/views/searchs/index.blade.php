@extends('layouts.app')
@section('content')
    
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            @if(!count($students))
                
                <div class="text-center">
                    <img src="/img/crazy-chicken.gif" alt="">
                    <div class="h2">
                        oh ow ! ' <span class="text-danger">{{$keyword}}</span> ' not found.. 
                    </div>
                </div>
            @else
                <div class="h2">keyword : '{{$keyword}}'</div>
                <ul class="list-group">
                    @foreach ($students as $student)
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                {{$student->fullname()}}
                            </div>
                            <a href="{{route('students.show',$student->id)}}" class="btn btn-sm btn-primary">View profile</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

@endsection