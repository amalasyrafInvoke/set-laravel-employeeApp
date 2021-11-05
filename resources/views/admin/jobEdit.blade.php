@extends('layout.default')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Job {{ $job->id }} </h1>
  </div>

  <form method="POST">
    @csrf
    <div class="form-group">
      <label for="title">Title</label>
      <input value="{{ $job->title }}" type="text" class="form-control" name="title" id="title" placeholder="Enter title">
    </div>
    <div class="form-group">
    <label for="description">Description</label>
    <input type="text" value="{{ $job->description }}" class="form-control" name="description" id="description">
  </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@stop