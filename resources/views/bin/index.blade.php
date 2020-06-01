@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="d-flex justify-content-between align-items-baseline">
                <h5>
                    Programs
                </h5>
                <div>
                    <a href="#" class="btn btn-sm btn-outline-danger" onclick="deleteall(deleteprogram,'Programs')">Clear all</a>
                <form action="{{route('programs.destroy.all')}}" method="POST" id="deleteprogram">
                    @csrf
                    @method('delete')
                </form>
                </div>
            </div>
            <ul class="list-group">
                @forelse (\App\Program::where('in_bin',1)->orderBy('updated_at','DESC')->get() as $item)
                    
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <a href="{{route('programs.bin',$item->id)}}"><i class="fa fa-trash-restore  text-success mr-2"></i></a>
                            {{$item->name}}

                        </div>
                        <div>
                        
                        <a href="#"><i class="fa fa-times-circle text-danger" onclick="callDelete('{{$item->name}}','{{route('programs.destroy',$item->id)}}')"></i></a>
                        </div>
                    </li>
                    
                    @empty
                        <li class="list-group-item bg-light">
                            Empty 
                        </li>
                    @endforelse
            </ul>
        </div>
        <div class="col-md-4">
            <div class="d-flex justify-content-between align-items-baseline">
                <h5>
                    Students
                </h5>
                <div>
                    <a href="#" class="btn btn-sm btn-outline-danger" onclick="deleteall(deletestudent,'Students')">Clear all</a>
                <form action="{{route('students.destroy.all')}}" method="POST" id="deletestudent">
                    @csrf
                    @method('delete')
                </form>
                </div>
            </div>
            <ul class="list-group">
                @forelse (\App\Student::where('in_bin',1)->orderBy('updated_at','DESC')->get() as $item)
                    
            <li class="list-group-item d-flex justify-content-between">
                <div>
                    <a href="{{route('students.bin',$item->id)}}"><i class="fa fa-trash-restore  text-success mr-2"></i></a>
                    {{$item->fullname()}} - {{$item->program->name}}

                </div>
                <div>
                
                <a href="#"><i class="fa fa-times-circle text-danger" onclick="callDelete('{{$item->name}}','{{route('students.destroy',$item->id)}}')"></i></a>
                </div>
            </li>
            
            @empty
                <li class="list-group-item bg-light">
                    Empty
                </li>
            @endforelse
            </ul>
        </div>
        <div class="col-md-4">
            <div class="d-flex justify-content-between align-items-baseline">
                <h5>
                    Grades
                </h5>
                <div>
                    <a href="#" class="btn btn-sm btn-outline-danger" onclick="deleteall(deletegrades,'Grades')">Clear all</a>
                <form action="{{route('grades.destroy.all')}}" method="POST" id="deletegrades">
                    @csrf
                    @method('delete')
                </form>
                </div>
            </div>
            <ul class="list-group">
                @forelse (\App\Grade::where('in_bin',1)->orderBy('updated_at','DESC')->get() as $item)
                    
            <li class="list-group-item d-flex justify-content-between">
                <div>
                    <a href="{{route('grades.bin',$item->id)}}"><i class="fa fa-trash-restore  text-success mr-2"></i></a>
                    {{$item->code}} - {{$item->student->fullname()}}
                </div>
                <div>
                
                <a href="#"><i class="fa fa-times-circle text-danger" onclick="callDelete('{{$item->code.'-'.$item->student->fullname()}}','{{route('grades.destroy',$item->id)}}')"></i></a>
                </div>
            </li>
            
            @empty
                <li class="list-group-item bg-light">
                    Empty
                </li>
            @endforelse
            </ul>
        </div>
    </div>
@endsection