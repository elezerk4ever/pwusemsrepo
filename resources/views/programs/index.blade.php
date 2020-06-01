@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Table of Programs
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
                    @forelse ($programs as $program)
                        <tr>
                           
                            <td class="text-center">
                            <a href="{{route('programs.bin',$program->id    )}}" title="move to trash"><i class="fa fa-trash text-danger"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="{{route('programs.show',$program->id)}}">{{$program->name}}</a>
                            </td>
                            <td class="text-center">
                                {{$program->description}}
                            </td>
                            <td class="text-center">
                                {{$program->term}}
                            </td>
                            <td class="text-center">
                            <a href="{{$program->filePath()}}" download="{{$program->name.'_curriculum'}}" title="download"><i class="fa fa-download text-success"></i></a>
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
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Input Program
            </div>
            <div class="card-body">
            <form action="{{route('programs.store')}}"method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" class="form-control" type="text" name="name"required>
                        <small class="form-text text-muted">Ex. BSIT</small>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" class="form-control">
                        <small class="form-text text-muted">Ex. Bs. Information Technology</small>
                    </div>
                    <div class="form-group">
                        <label for="term">No. Term</label>
                        <input id="term" class="form-control" type="number" name="term" required>
                        <small class="form-text text-muted">Ex. 2</small>
                    </div>
                    <div class="custom-file mt-3 mb-3">
                        <input type="file" class="custom-file-input" id="customFile" name="file" accept=".xlsx,.docx,.doc" required>
                        <label class="custom-file-label" for="customFile">Curriculum file</label>
                    </div>

                    <button class="btn btn-block btn-primary">
                        Add program
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection