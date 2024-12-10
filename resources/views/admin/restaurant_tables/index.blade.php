
@extends('admin.layouts.master')
 
@section('content') 
 <!-- Content Wrapper. Contains page content -->
        <div class="row mb-2">
          <div class="col-sm-6">
            {{-- <h1 class="m-0">{{ $page_title }}</h1> --}}
           <a href="{{ route('RestaurantTables.create') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Add Table</button></a> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
     
    <!-- /.content-header -->

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form action="{{ route('RestaurantTables.updateAllStatus') }}" method="POST" style="display:inline;">
  @csrf
  <button type="submit" class="btn btn-success btn-sm">
      <i class="fa fa-check"></i> Mark All Unavailable as Available
  </button>
</form>

    <table class="table table-bordered table-hover">
      <thead>
          <tr>
            <th>Table Number</th>
            {{-- <th>Capacity</th> --}}
            <th>Status</th>
            <th>Actions</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($tables as $table)
            <tr>
                <td>{{ $table->table_number }}</td>
                {{-- <td>{{ $table->capacity }}</td> --}}
                <td>
                    <form action="{{ route('RestaurantTables.toggleStatus', $table->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-{{ $table->is_enabled ? 'success' : 'danger' }}">
                            {{ $table->is_enabled ? 'Available' : 'Unavailable' }}
                        </button>
                    </form>
                </td>
                <td>
                    <a href="edit/{{ $table->id }}">
                        <div style="display: flex; flex-direction:row;">
                            <button type="button" class="btn btn-block btn-warning btn-sm"><i
                                    class="fas fa-edit"></i> Edit </button>
                    </a>
                    <form action="{{ url('admin/restaurant-tables/delete/'.$table->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-block btn-danger btn-sm" style="width:auto;">Delete</button>
                    </form>                    

            </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  @stop