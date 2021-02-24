@extends('layouts.sb-admin')
@section('titlehtml', 'List Postingan')
@section('content')
<!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Post</h1>
    <p class="mb-4">This is Post for Admin</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Postingan</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach($posts as $keypost)
              <tr>
                <td> <img src="{{asset($keypost->featured)}}" alt="{{$keypost->title}}" width="90px" height="50px"> </td>
                <td>{{$keypost->title}}</td>
                <td>{{$keypost->category->name}}</td>
                <td> <a href="{{route('posts-edit', ['id' => $keypost->id])}}" class="btn btn-m btn-info">Edit</a> </td>
                <td> <a href="" class="btn btn-m btn-danger" data-toggle="modal" data-target="#deleteModal{{$keypost->id}}" >Buang</a> </td>
              </tr>
              <div class="modal fade" id="deleteModal{{$keypost->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Are You Sure to Delete "{{$keypost->title}}" post ?</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">Select "Delete" below if you delete it.</div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                      <a class="btn btn-danger" href="{{route('posts-buang', ['id' => $keypost->id])}}">Delete</a>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
