@extends('layouts.app')

@section('title', 'Edit-User')

@section('contents')

<a href="{{route('profile')}}" class="d-none d-sm-inline-block btn btn-primary shadow-sm float-right" 
    style="margin-top: 15px"><i
    class="fas fa-arrow-left fa-sm text-white-50"></i>  
    BACK
</a>
<h1 class="mb-0">Profile</h1>
<hr />
<div class="container-fluid">
    <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="{{ route('profile.update', $user->id) }}" >
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                    <div class="row" id="res"></div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $user->name }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Email</label>
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}" placeholder="Email">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Status</label>
                            <input type="text" name="level" class="form-control" value="{{ $user->level }}" placeholder="Status">
                        </div>
                    </div>
                    
                    <div class="mt-5 text-center">
                        <button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button>
                    </div>
                </div>
            </div>
        </div>           
    </form>
</div>

@endsection