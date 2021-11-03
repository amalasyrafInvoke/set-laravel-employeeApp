@extends('layout.default')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit User </h1>
  </div>

  <form method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Name</label>
      <input value="{{ $user->name }}" type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp" placeholder="Enter name">
      <small id="nameHelp" class="form-text text-muted">We'll never share your personal info with anyone else.</small>
    </div>
    <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" value="{{ $user->email }}" class="form-control" name="email" id="email" disabled>
  </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@stop