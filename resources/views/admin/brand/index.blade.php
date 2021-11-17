@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   All Brand
                </div>

                <div class="card-body">
                    @if(session('Success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('Success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>

                      @endif
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">SL No</th>
                            <th scope="col">B Name</th>
                            <th scope="col">B Image</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                            <tr>
                                <th scope="row">{{$brands->firstItem()+$loop->index}}</th>
                                <td>{{$brand->brand_name}}</td>
                                <td><img src="{{asset($brand->brand_image)}}" style="height:35px; width:55px" alt=""></td>
                                <td>{{$brand->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{url('Edit/Brands/'.$brand->id)}}" class="btn btn-success">Edit</a>
                                    <a href="{{url('Delete/Brands/'.$brand->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$brands->links()}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <p>Add Brand</p>
                </div>
                <div class="card-body">
                    <form action="{{route('add.brand')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                          <input type="text" placeholder="Enter Brand Name" class="form-control @error('brand_name') is-invalid
                          @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" name="brand_name">

                          {{-- <img src="" alt="" placeholder="Input Brand Image"> --}}
                          @error('brand_name')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Brand Image</label>
                            <input type="file" placeholder="Enter Brand Image" class="form-control @error('brand_image') is-invalid
                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" name="brand_image">

                            {{-- <img src="" alt="" placeholder="Input Brand Image"> --}}
                            @error('brand_image')
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

