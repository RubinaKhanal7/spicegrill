@extends('admin.layouts.master')

@section('content') 

<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">{{ $page_title }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
      </div>
  </div>

  @if(session('successMessage'))
      <div class="alert alert-success">
          {{ session('successMessage') }}
      </div>
  @endif

  @if(session('errorMessage'))
      <div class="alert alert-danger">
          {{ session('errorMessage') }}
      </div>
  @endif

  <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>S.N</th>
            <th>Fullname</th>
            <th>Phone Number</th>
            <th>Number Of People</th>
            <th>Table Number</th>
            <th>Start Time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($booktables as $booktable)
            <tr data-widget="expandable-table" aria-expanded="false">
                <th>{{ $loop->iteration }}</th>
                <td>{{ $booktable->fullname ?? '' }}</td>
                <td>{{ $booktable->phone_no ?? '' }}</td>
                <td>{{ $booktable->no_of_people ?? '' }}</td>
                <td>{{ $booktable->table_number ?? '' }}</td>
                <td>{{ $booktable->booking_start_time ?? '' }}</td>
                <td>
                    <form action="{{ route('BookTables.destroy', $booktable->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-block btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
@stop
