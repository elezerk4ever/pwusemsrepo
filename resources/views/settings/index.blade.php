@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fa fa-cog"></i> Setting
                </div>
                <div class="card-body">
                <form method="POST" action="{{route('settings.update',auth()->user()->id)}}">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="username">Username</label>
                        <input id="username" class="form-control" type="text" value="{{auth()->user()->username}}" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Old Password</label>
                            <input id="password" class="form-control" type="password" name="old_password">
                        </div>
                        <div class="form-group">
                            <label for="newpassword">New Password</label>
                            <input id="newpassword" class="form-control" type="password" name="new_password">
                        </div>
                        <button class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection