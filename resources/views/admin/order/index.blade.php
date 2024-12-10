@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Orders</h1>
         <a href="{{ url('admin/post/create') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Add Posts</button></a> 
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Total Amount</th>
                <th>Food Ordered</th>
                <th>Quantity</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>${{ $order->total_amount }}</td>
                <td>
                    @foreach($order->order_details as $item)
                        {{ $item['name'] ?? 'NA' }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach($order->order_details as $item)
                        {{ $item['quantity'] }}<br>
                    @endforeach
                </td>
                <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    @if($order->status == 'Incomplete')
                        <form action="{{ route('admin.orders.complete', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-warning">Mark as Complete</button>
                        </form>
                    @else
                        <span class="text-success">Completed</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
</div>
@endsection