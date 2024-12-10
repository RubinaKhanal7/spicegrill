@extends('layouts.master')

@section('content')
@include('includes.page_header')

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<section class="single_service_page">
    <div class="container">
        <div class="row" style="margin-left: 400px; width:1500px;">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header text-white text-center" style="background-color: #243b55;">
                        <h4><i class="fas fa-utensils mr-2"></i> Book a Table</h4>
                    </div>                    
                    <div class="card-body">
                        <form id="booktableForm" action="{{ route('BookTables.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="fullname"><i class="fas fa-user mr-2"></i> Fullname</label>
                                <input class="form-control" id="fullname" name="fullname" type="text" placeholder="Fullname" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone_number"><i class="fas fa-phone mr-2"></i> Phone Number</label>
                                <input class="form-control" id="phone_number" name="phone_no" type="number" placeholder="Phone Number" min="1" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="no_of_people"><i class="fas fa-users mr-2"></i> Number Of People</label>
                                <input class="form-control" id="no_of_people" name="no_of_people" type="number" placeholder="Number Of People" min="1" required/>
                            </div>
                            <button class="btn btn-primary w-100" type="submit" style="background-color: #243b55; border-color: #243b55;">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
