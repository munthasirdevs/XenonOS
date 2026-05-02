<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    use ApiResponse;

    public function dashboard()
    {
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');
        
        $pendingInvoices = Invoice::whereIn('status', ['draft', 'sent'])->sum('total');
        
        $overdueInvoices = Invoice::where('status', 'sent')
            ->where('due_date', '<', now())
            ->count();

        $paidThisMonth = Payment::where('status', 'completed')
            ->whereMonth('received_at', now()->month)
            ->whereYear('received_at', now()->year)
            ->sum('amount');

        $sentThisMonth = Invoice::where('status', 'sent')
            ->whereMonth('sent_at', now()->month)
            ->whereYear('sent_at', now()->year)
            ->sum('total');

        return $this->success([
            'total_revenue' => $totalRevenue,
            'pending_amount' => $pendingInvoices,
            'overdue_count' => $overdueInvoices,
            'paid_this_month' => $paidThisMonth,
            'sent_this_month' => $sentThisMonth,
        ]);
    }

    public function revenueChart(Request $request)
    {
        $months = $request->months ?? 12;
        
        $revenue = Payment::where('status', 'completed')
            ->where('received_at', '>=', now()->subMonths($months))
            ->selectRaw(
                "DATE_FORMAT(received_at, '%Y-%m') as month, 
                SUM(amount) as total"
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return $this->success($revenue);
    }

    public function invoiceStatus()
    {
        $status = Invoice::selectRaw('status, COUNT(*) as count, SUM(total) as total')
            ->groupBy('status')
            ->get();

        return $this->success($status);
    }

    public function clientRevenue(Request $request)
    {
        $clients = Invoice::with('client:id,name')
            ->whereHas('payments', function ($q) {
                $q->where('status', 'completed');
            })
            ->selectRaw('client_id, SUM(total) as total_invoiced')
            ->groupBy('client_id')
            ->orderByDesc('total_invoiced')
            ->limit(20)
            ->get();

        return $this->success($clients);
    }

    public function overdueInvoices()
    {
        $invoices = Invoice::with('client:id,name')
            ->where('status', 'sent')
            ->where('due_date', '<', now())
            ->orderBy('due_date')
            ->get();

        return $this->success($invoices);
    }

    public function agingReport()
    {
        $报告 = [
            'current' => Invoice::where('status', 'sent')
                ->where('due_date', '>=', now()->subDays(30))->sum('total'),
            '1_30_days' => Invoice::where('status', 'sent')
                ->whereBetween('due_date', [now()->subDays(60), now()->subDays(31)])->sum('total'),
            '31_60_days' => Invoice::where('status', 'sent')
                ->whereBetween('due_date', [now()->subDays(90), now()->subDays(61)])->sum('total'),
            'over_90_days' => Invoice::where('status', 'sent')
                ->where('due_date', '<', now()->subDays(90))->sum('total'),
        ];

        return $this->success($报告);
    }

    public function export(Request $request)
    {
        $invoices = Invoice::with(['client:id,name', 'payments'])
            ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->get();

        return $this->success($invoices);
    }
}