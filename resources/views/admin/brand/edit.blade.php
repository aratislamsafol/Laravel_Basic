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
                      <form action="{{url('Brand/Update/'.$brands->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                          <input type="text" value="{{$brands->brand_name}}" class="form-control @error('category_name') is-invalid
                          @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" name="brand_name">

                          @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>

                        <div class="mb-3">
                            <input type="hidden" name="old_img" value="{{$brands->brand_image}}">
                            <label for="exampleInputEmail1" class="form-label">Brand Image</label>
                            <input type="file" value="{{($brands->brand_image)}}" class="form-control @error('brand_image') is-invalid
                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" name="brand_image">

                            {{-- <img src="" alt="" placeholder="Input Brand Image"> --}}
                            @error('brand_image')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <img src="{{asset($brands->brand_image)}}" class="" style="height:270px; width:370px" alt="">
                         </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


