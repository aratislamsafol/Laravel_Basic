@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if(session('Success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('Success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
                      <form action="{{route('change.action')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Old Password</label>
                            <input type="text" placeholder="Type Old Password" class="form-control @error('old_pass') is-invalid
                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" name="old_pass">

                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{session('error')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @error('old_pass')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">New Password</label>
                            <input type="text" placeholder="Type New Password" class="form-control @error('new_pass') is-invalid
                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" name="new_pass">

                            @error('new_pass')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div><div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
                            <input type="text" placeholder="Type Confirm Password " class="form-control @error('confirm_pass') is-invalid
                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" name="confirm_pass">

                            @if(session('danger'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{session('danger')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            @error('confirm_pass')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


