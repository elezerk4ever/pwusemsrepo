@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Import grades
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('grades.import')}}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-6">
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
                        </div>
                        <div class="col-md-6">
                            
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
                                <input id="is_ojt" class="form-check-input" type="checkbox" name="is_ojt" value="1">
                                <label for="is_ojt" class="form-check-label">Check if it is OJT</label>
                            </div>
                            <div class="custom-file mt-3 mb-3">
                                <input type="file" class="custom-file-input" id="customFile" name="file" accept=".xlsx">
                                <label class="custom-file-label" for="customFile">xlsx only</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fa fa-file-excel"></i> Import Grades
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection