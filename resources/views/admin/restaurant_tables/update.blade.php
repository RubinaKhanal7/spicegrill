@extends('admin.layouts.master')

@section('content')
   
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">{{ $page_title }}</h1> --}}
                    {{-- <a href="{{ url('admin/posts/add') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Add Team Member</button></a> --}}
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('RestaurantTables.update', $restaurantTable->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="table_number">Table Number</label>
            <input type="number" name="table_number" id="table_number" class="form-control" value="{{ $restaurantTable->table_number }}" min="1" required>
        </div>
        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" name="capacity" id="capacity" class="form-control" value="{{ $restaurantTable->capacity }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Table</button>
    </form>
@endsection
