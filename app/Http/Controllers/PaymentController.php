<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function showPayments()
    {
        $payments = Payment::orderBy('created_at', 'desc')->get();
        $total = $payments->sum('amount');
        $page_title = 'Payment Information';
        return view('admin.payment.index', compact('payments', 'page_title', 'total'));
    }

    public function destroyPayment($id)
{
    $payment = Payment::findOrFail($id);
    $payment->delete();

    return redirect()->route('admin.payments')->with('successMessage', 'Payment record deleted successfully.');
}

}

