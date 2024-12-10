<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\BookTable;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $today = Carbon::today();
        
        $todaysBookingsCount = BookTable::whereDate('booking_start_time', $today)->count();
        $todaysOrderCount = Order::whereDate('created_at',$today)->count();
        $todaysPaymentCount = Payment::whereDate('created_at',$today)->count();
        $todaysdeliveryCount = Order::whereDate('created_at', $today)
            ->where('status', 'Completed')
            ->count();
        return view('admin.index', compact('todaysBookingsCount','todaysOrderCount','todaysPaymentCount','todaysdeliveryCount'));
    }
}
