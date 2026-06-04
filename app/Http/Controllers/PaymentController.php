<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['invoice.client', 'receivedBy'])
            ->latest()
            ->limit(20);

        $payments = $query->get();

        // Stats
        $totalRevenue = Cache::remember('payments_total_revenue', 60, function() {
            return Payment::where('status', 'completed')
                ->sum('amount') ?? 0;
        });

        $pendingAmount = Cache::remember('payments_pending', 60, function() {
            return Payment::where('status', 'pending')
                ->sum('amount') ?? 0;
        });

        $completedCount = Payment::where('status', 'completed')->count();
        $failedCount = Payment::where('status', 'failed')->count();

        $stats = [
            'total_revenue' => $totalRevenue,
            'pending_amount' => $pendingAmount,
            'completed_count' => $completedCount,
            'failed_count' => $failedCount,
        ];

        return view('payments.index', compact('payments', 'stats'));
    }

    public function create(Request $request)
    {
        $clients = Client::where('status', 'active')
            ->orderBy('name')
            ->get(['id', 'name', 'email', 'company']);

        return view('payments.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0.01',
            'method' => 'required|in:cash,bank_transfer,check,other',
        ]);

        $payment = DB::transaction(function () use ($validated) {
            $invoice = Invoice::create([
                'client_id' => $validated['client_id'],
                'invoice_number' => 'INV-' . time() . rand(100, 999),
                'status' => 'pending',
                'due_date' => now()->addDays(30),
            ]);

            return Payment::create([
                'invoice_id' => $invoice->id,
                'amount' => $validated['amount'],
                'method' => $validated['method'],
                'status' => 'pending',
                'transaction_ref' => 'TXN-' . strtoupper(uniqid()),
            ]);
        });

        return redirect()->route('payments.show', $payment->id)
            ->with('success', 'Payment request created');
    }

    public function show($id)
    {
        $payment = Payment::with(['invoice.client', 'receivedBy', 'refundedBy'])
            ->findOrFail($id);

        return view('payments.show', compact('payment'));
    }

    public function updateStatus(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:completed,pending,failed,refunded',
        ]);

        DB::transaction(function () use ($payment, $request) {
            $payment->update([
                'status' => $request->status,
                'received_at' => $request->status === 'completed' ? now() : null,
                'received_by' => $request->status === 'completed' ? auth()->id() : null,
            ]);

            if ($payment->invoice) {
                $payment->invoice->update([
                    'status' => $request->status === 'completed' ? 'paid' : 'pending',
                ]);
            }
        });

        Cache::forget('payments_total_revenue');
        Cache::forget('payments_pending');

        return back()->with('success', 'Payment status updated');
    }
}