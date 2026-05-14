<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $stats = [
            'totalRevenue' => Payment::where('status', 'completed')->sum('amount') ?? 0,
            'monthlyRevenue' => Payment::where('status', 'completed')
                ->whereMonth('created_at', now()->month)
                ->sum('amount') ?? 0,
            'outstanding' => Invoice::whereIn('status', ['sent', 'viewed'])->sum('total') ?? 0,
            'activeSubscriptions' => Subscription::where('status', 'active')->count(),
        ];

        $recentInvoices = Invoice::with(['client'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentPayments = Payment::with(['invoice'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('billing.index', compact('stats', 'recentInvoices', 'recentPayments'));
    }

    public function invoices()
    {
        $invoices = Invoice::with(['client'])
            ->when(request()->has('status'), function ($query) {
                if (request('status') !== 'all') {
                    $query->where('status', request('status'));
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('billing.invoices', compact('invoices'));
    }

    public function invoiceDetails(Invoice $invoice)
    {
        $invoice->load(['client', 'items']);

        return view('billing.invoice-details', compact('invoice'));
    }

    public function transactions()
    {
        $payments = Payment::with(['invoice'])
            ->when(request()->has('status'), function ($query) {
                if (request('status') !== 'all') {
                    $query->where('status', request('status'));
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('billing.transactions', compact('payments'));
    }
}