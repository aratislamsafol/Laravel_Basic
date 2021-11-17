@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

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
                            <th scope="col">Category Name</th>
                            <th scope="col">Creators</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $cat)
                            <tr>
                                <th scope="row">{{$category->firstItem()+$loop->index}}</th>
                                <td>{{$cat->category_name}}</td>
                                <td>{{$cat->user->name}}</td>
                                <td>{{$cat->created_at->diffForHumans()}}</td>
                                <td><a href="{{url('Category/Edit/'.$cat->id)}}" class="btn btn-success">Edit</a>
                                    <a href="{{url('Category/Delete/'.$cat->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$category->links()}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <p>Add Category</p>
                </div>
                <div class="card-body">
                    <form action="{{route('store.cat')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Category Name</label>
                          <input type="text" placeholder="Enter Category Name" class="form-control @error('category_name') is-invalid
                          @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" name="category_name">

                          @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 pt-5">
            <div class="card">
                <div class="card-header">
                    Trash List
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
                            <th scope="col">Category Name</th>
                            <th scope="col">Creators</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($trashcat as $t_cat)
                            <tr>
                                <th scope="row">{{$trashcat->firstItem()+$loop->index}}</th>
                                <td>{{$t_cat->category_name}}</td>
                                <td>{{$t_cat->user->name}}</td>
                                <td>{{$t_cat->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{url('Cat/Data/Restore/'.$t_cat->id)}}" class="btn btn-success">Restore</a>
                                    <a href="{{url('Cat/Data/P_Delete/'.$t_cat->id)}}" class="btn btn-danger">P_Del</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$trashcat->links()}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
@endsection

