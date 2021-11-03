@extends('layout.default')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Department List</h1>
  </div>

  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Department</th>
        <th scope="col">Created Date</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($departmentList as $dept)
      <tr>
        <th scope="row">{{ $dept->id }}</th>
        <td>{{ $dept->name }}</td>
        <td>{{ $dept->created_at }}</td>
        <td>
          <a href="{{ route('admin.departmentEdit', ['id' => $dept->id]) }}">Edit</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $departmentList-> links('pagination::bootstrap-4') }}

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@stop