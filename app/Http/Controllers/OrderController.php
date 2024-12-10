<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('payment')->latest()->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function complete(Order $order)
{
    $order->update(['status' => 'Completed']);
    return back()->with('success', 'Order marked as completed.');
}
}
