@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-deck">
                @foreach ($multi as $multiple)
                <div class="col-md-4 p-2">
                  <div class="card">
                        <img src="{{asset($multiple->multiimage)}}" class="card-img-top" alt="multiple Image">
                        <div class="card-body">
                            <h5 class="card-title">Details</h5>
                            <p class="card-text">{{$multiple->created_at->diffForHumans()}}</p>
                            <a class="btn btn-sm btn-danger" href="{{url('MultiImage/Delete/'.$multiple->id)}}">Delete</a>
                        </div>
                  </div>
                </div>

                @endforeach
            </div>
            {{$multi->links()}}
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <p>Add Image</p>
                </div>
                <div class="card-body">
                    <form action="{{route('add.multi')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Multiple Image</label>
                            <input type="file" class="form-control @error('multi_image') is-invalid
                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" name="multi_image[]" multiple>

                            {{-- <img src="" alt="" placeholder="Input Brand Image"> --}}
                            @error('multi_image')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

