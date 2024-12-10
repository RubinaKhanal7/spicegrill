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
            <th>Full Name</th>
            <th>State</th>
            <th>City</th>
            <th>Street Address</th>
            <th>Postal Code</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Amount</th>
            <th>Stripe Charge ID</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
        <tr data-widget="expandable-table" aria-expanded="false">
            <th>{{ $loop->iteration }}</th>
            <td>{{ $payment->name ?? '' }}</td>
            <td>{{ $payment->state ?? '' }}</td>
            <td>{{ $payment->city ?? '' }}</td>
            <td>{{ $payment->street_address ?? '' }}</td>
            <td>{{ $payment->postal_code ?? '' }}</td>
            <td>{{ $payment->phone ?? '' }}</td>
            <td>{{ $payment->email ?? '' }}</td>
            <td>${{ $payment->amount ?? '' }}</td>
            <td>{{ $payment->stripe_charge_id ?? '' }}</td>
            <td>{{ $payment->created_at->format('Y-m-d H:i:s') ?? '' }}</td>
            <td>
                <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-block btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this payment record?');">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    
    </tbody>
</table>
@stop
