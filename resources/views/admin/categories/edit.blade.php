@extends('layouts.sb-admin')
@section('titlehtml', 'Edit Kategori - '.$category->name)
@section('content')
<!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Categories</h1>
    <p class="mb-4">This is Categori for Admin</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Kategori <strong>{{$category->name}}</strong> </h6>
        </div>
        <div class="card-body">
          <form class="" action="{{route('categories-update', ['id' => $category->id])}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
              <label for="Nama">Nama</label>
              <input type="text" name="name" value="{{$category->name}}" class="form-control">
            </div>
            <div class="form-group">
              <button type="submit" name="btn" class="btn btn-success">Edit</button>
            </div>
          </form>
        </div>
    </div>
  </div>
@endsection
