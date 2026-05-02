<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Payment::with(['invoice', 'receivedBy:id,name'])->orderBy('created_at', 'desc');

        if ($request->has('invoice_id')) {
            $query->where('invoice_id', $request->invoice_id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->paginate(20);
        return $this->success($payments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|numeric|min:0.01',
            'method' => 'required|in:cash,bank_transfer,check,card,other',
            'transaction_ref' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $invoice = Invoice::findOrFail($request->invoice_id);

        if ($invoice->status === 'paid') {
            return $this->error('Invoice already paid', 422);
        }

        $payment = DB::transaction(function () use ($request, $invoice) {
            $payment = Payment::create([
                'invoice_id' => $request->invoice_id,
                'amount' => $request->amount,
                'method' => $request->method,
                'transaction_ref' => $request->transaction_ref,
                'status' => 'completed',
                'received_by' => $request->user()->id,
                'received_at' => now(),
                'notes' => $request->notes,
            ]);

            $totalPaid = $invoice->payments()->where('status', 'completed')->sum('amount') + $request->amount;
            
            if ($totalPaid >= $invoice->total) {
                $invoice->update(['status' => 'paid', 'paid_at' => now()]);
            } else {
                $invoice->update(['status' => 'partial']);
            }

            return $payment;
        });

        return $this->success($payment->load('invoice'), 'Payment recorded', 201);
    }

    public function show(Payment $payment)
    {
        $payment->load(['invoice', 'receivedBy:id,name']);
        return $this->success($payment);
    }

    public function refund(Request $request, Payment $payment)
    {
        if ($payment->status === 'refunded') {
            return $this->error('Payment already refunded', 422);
        }

        $request->validate([
            'reason' => 'required|string',
        ]);

        $payment->update([
            'status' => 'refunded',
            'refund_reason' => $request->reason,
            'refunded_by' => $request->user()->id,
            'refunded_at' => now(),
        ]);

        $invoice = $payment->invoice;
        $totalPaid = $invoice->payments()->where('status', 'completed')->sum('amount');
        
        if ($totalPaid < $invoice->total) {
            $invoice->update(['status' => 'sent']);
        }

        return $this->success(null, 'Payment refunded');
    }

    public function methodStats()
    {
        $stats = Payment::where('status', 'completed')
            ->selectRaw('method, COUNT(*) as count, SUM(amount) as total')
            ->groupBy('method')
            ->get();

        return $this->success($stats);
    }
}