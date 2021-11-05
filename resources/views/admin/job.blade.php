@extends('layout.default')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Job List</h1>
  </div>

  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Job Title</th>
        <th scope="col">Job Description</th>
        <th scope="col">Min Salary (RM)</th>
        <th scope="col">Max Salary (RM)</th>
        <th scope="col">Created Date</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($jobList as $job)
      <tr>
        <th scope="row">{{ $job->id }}</th>
        <td>{{ $job->title }}</td>
        <td>{{ $job->description }}</td>
        <td>{{ $job->min_salary }}</td>
        <td>{{ $job->max_salary }}</td>
        <td>{{ $job->created_at }}</td>
        <td>
          <a class="mx-1" href="{{ route('admin.jobEdit', ['id' => $job->id]) }}">Edit</a>
          <a class="mx-1 text-danger" href="{{ route('admin.jobDelete', ['id' => $job->id]) }}">Delete</a>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $jobList-> links('pagination::bootstrap-4') }}

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@stop