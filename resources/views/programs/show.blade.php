@extends('layouts.app')
@section('content')
<div class="d-print-none mb-2 text-right">
    <button class="btn btn-primary btn-sm" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
</div>
<div class="row justify-content-center">
    <div class="col">
        <h2 class="d-flex justify-content-between">
            {{$program->name}}
            <div>
                <a href="{{route('programs.bin',$program->id)}}" title="move to trash" class="d-print-none"><i class="fa fa-trash{{$program->in_bin ? '-restore text-success':' text-danger'}} "></i></a>
            </div>
        </h2>
        <div class="d-flex">
            <strong class="mr-4">Description : {{$program->description}}</strong>
            <strong class="mr-4">
                No. Term : {{$program->term}} year(s)
            </strong>
            <strong class="mr-4 d-print-none">
            Curriculum : <a href="{{$program->filePath()}}" download={{$program->name.'_curriculum'}}>
            <i class="fa fa-download"></i> Download file
            </a>
            </strong>
        </div>
        <hr>
        <h5 class="text-center">
            Students 
        </h5>
        <table class="table-bordered w-100 d-print-table">
            <tr>
                <th class="d-print-none">

                </th>
                <th>
                    ID #
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
            @foreach ($program->students()->orderBy('firstname')->get() as $student)
                <tr>
                    <td class="d-print-none">
                        <i class="fa fa-trash text-danger"></i>
                        <a href="#"></a>
                    </td>
                    <td>
                        {{$student->idnumber}}
                    </td>
                    <td>
                        {{$student->fullname()}}
                    </td>
                    <td>
                        {{$student->gender[0]}}
                    </td>
                    <td>
                        {{$student->birthdate}}
                    </td>
                </tr>
            @endforeach
        </table>
        
    </div>
    <div class="col-md-3 d-print-none">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Edit program
            </div>
            <div class="card-body">
                <form action="{{route('programs.update',$program->id)}}"method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                        <input id="name" class="form-control" type="text" name="name"required value="{{$program->name}}">
                            <small class="form-text text-muted">Ex. BSIT - Bs. Information Technology</small>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                        <input type="text" id="description" name="description" class="form-control" value="{{$program->description}}">
                            <small class="form-text text-muted">Ex. Effective A.Y 20 **</small>
                        </div>
                        <div class="form-group">
                            <label for="term">No. Term</label>
                            <input id="term" class="form-control" type="number" name="term" required value="{{$program->term}}">
                            <small class="form-text text-muted">Ex. 2</small>
                        </div>
                        <div class="custom-file mt-3 mb-3 " >
                            <input type="file" class="custom-file-input" id="customFile" name="file" required>
                            <label class="custom-file-label" for="customFile">Custom file upload</label>
                        </div>
                        <button class="btn btn-block btn-primary">
                            Update program
                        </button>
                    </form>
            </div>
        </div>
    </div>
</div>

@endsection