@extends('layouts.sb-admin')
@section('titlehtml', 'Edit Postingan - '.$keypost->title)
@section('content')
<!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Postingan</h1>
    <p class="mb-4">This is Posts for Admin</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Postingan</h6>
        </div>
        <div class="card-body">
          <form action="{{route('posts-update', ['id' => $keypost->id])}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ $keypost->title }}">
              @error('title')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="category_id">Category</label>
              <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" value="{{$keypost->category_id }}">
                @foreach($categoris as $key)
                  @if($keypost->category_id == $key->id)
                    <option value="{{$key->id}}" selected>{{$key->name}}</option>
                  @else
                    <option value="{{$key->id}}">{{$key->name}}</option>
                  @endif
                @endforeach
              </select>
              @error('category_id')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="content">Content</label>
              <textarea id="editor" name="content" class="form-control @error('content') is-invalid @enderror">{{$keypost->content }}</textarea>
              @error('content')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="featured">Image</label>
              <input type="file" name="featured" class="form-control">
            </div>
            <div class="form-group">
              <button type="submit" name="btn" class="btn btn-success">Edit</button>
            </div>
          </form>
        </div>
    </div>
  </div>
@endsection
