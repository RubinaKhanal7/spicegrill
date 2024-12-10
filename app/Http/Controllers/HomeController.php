<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookTable;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::today();
        
        $todaysBookingsCount = BookTable::whereDate('booking_start_time', $today)->count();
        $todaysOrderCount = Order::whereDate('created_at',$today)->count();
        $todaysPaymentCount = Payment::whereDate('created_at',$today)->count();
        $todaysdeliveryCount = Order::whereDate('created_at', $today)
            ->where('status', 'Completed')
            ->count();
        return view('admin/index', compact('todaysBookingsCount','todaysOrderCount','todaysPaymentCount','todaysdeliveryCount'));
    }
   
}
