@extends('layouts.sb-admin')

@section('titlehtml', 'Tambah Kategori')
@section('content')
<!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Categories</h1>
    <p class="mb-4">This is Categori for Admin</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Kategori</h6>
        </div>
        <div class="card-body">
          <form action="{{route('categories-store')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Kategori" value="{{ old('name') }}" required>
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <button type="submit" name="btn" class="btn btn-success">Add</button>
            </div>
          </form>
        </div>
    </div>
  </div>
@endsection
