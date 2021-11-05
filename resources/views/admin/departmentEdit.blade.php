@extends('layout.default')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Department {{ $dept->id }}</h1>
  </div>

  <form method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Title</label>
      <input value="{{ $dept->name }}" type="text" class="form-control" name="name" id="name" placeholder="Enter title">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@stop