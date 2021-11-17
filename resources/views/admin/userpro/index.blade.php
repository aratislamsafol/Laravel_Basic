@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Profile</h5>
                </div>
                <div class="card-body">
                    @if (session('Success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('Success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form action="{{route('update.profile')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control @error('user_email') is-invalid
                            @enderror" value={{Auth::user()->email}} id="exampleInputEmail1" aria-describedby="emailHelp" name="user_email">

                            @error('user_email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">UserName</label>
                            <input type="text" class="form-control @error('user_name') is-invalid
                            @enderror" value={{Auth::user()->name}} id="exampleInputPassword1" name="user_name">

                            @error('user_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                            <button type="submit" class="btn btn-primary">Update</button>


                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><img class="rounded-circle form-control m-0" src="{{asset('image/avatar.jpg')}}" style="height: 200px; width: 220px;" class="card-img-top" alt="..."></li>
                        <li class="list-group-item">{{Auth::User()->name}}</li>
                        <li class="list-group-item">{{Auth::User()->email}}</li>
                        <li class="list-group-item"><a href="{{route('change.password')}}">Change Password</a></li>
                    </ul>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection

