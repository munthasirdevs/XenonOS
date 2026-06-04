<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Client;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    use ApiResponse;

    public function dashboard()
    {
        $stats = Cache::remember('billing_dashboard', 60, function() {
            return [
                'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
                'pending_amount' => Invoice::whereIn('status', ['draft', 'sent'])->sum('total'),
                'overdue_count' => Invoice::where('status', 'sent')->where('due_date', '<', now())->count(),
                'paid_this_month' => Payment::where('status', 'completed')->whereMonth('received_at', now()->month)->whereYear('received_at', now()->year)->sum('amount'),
                'sent_this_month' => Invoice::where('status', 'sent')->whereMonth('sent_at', now()->month)->whereYear('sent_at', now()->year)->sum('total'),
            ];
        });

        return $this->success($stats);
    }

    public function revenueChart(Request $request)
    {
        $months = $request->months ?? 12;
        $cacheKey = "billing_revenue_{$months}";
        
        $revenue = Cache::remember($cacheKey, 60, function() use ($months) {
            return Payment::where('status', 'completed')
                ->where('received_at', '>=', now()->subMonths($months))
                ->selectRaw("DATE_FORMAT(received_at, '%Y-%m') as month, SUM(amount) as total")
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        });

        return $this->success($revenue);
    }

    public function invoiceStatus()
    {
        $status = Cache::remember('billing_invoice_status', 60, function() {
            return Invoice::selectRaw('status, COUNT(*) as count, SUM(total) as total')
                ->groupBy('status')
                ->get();
        });

        return $this->success($status);
    }

    public function clientRevenue(Request $request)
    {
        $clients = Cache::remember('billing_client_revenue', 60, function() {
            return Invoice::with('client:id,name')
                ->whereHas('payments', function($q) { $q->where('status', 'completed'); })
                ->selectRaw('client_id, SUM(total) as total_invoiced')
                ->groupBy('client_id')
                ->orderByDesc('total_invoiced')
                ->limit(20)
                ->get();
        });

        return $this->success($clients);
    }

    public function overdueInvoices()
    {
        $invoices = Cache::remember('billing_overdue', 30, function() {
            return Invoice::where('status', 'sent')
                ->where('due_date', '<', now())
                ->with('client:id,name,email')
                ->select('id', 'client_id', 'invoice_number', 'total', 'due_date', 'status')
                ->latest()
                ->paginate(15);
        });

        return $this->success($invoices);
    }

    public function agingReport(Request $request)
    {
        $days = (int) $request->get('days', 30);
        $doubleDays = $days * 2;
        $cacheKey = "billing_aging_{$days}";
        
        $aging = Cache::remember($cacheKey, 60, function() use ($days, $doubleDays) {
            return Invoice::where('status', 'sent')
                ->whereNotNull('due_date')
                ->selectRaw('
                    SUM(CASE WHEN due_date > DATE_SUB(NOW(), INTERVAL ? DAY) THEN total ELSE 0 END) as current,
                    SUM(CASE WHEN due_date BETWEEN DATE_SUB(NOW(), INTERVAL ? DAY) AND DATE_SUB(NOW(), INTERVAL ? DAY) THEN total ELSE 0 END) as overdue_31_60,
                    SUM(CASE WHEN due_date < DATE_SUB(NOW(), INTERVAL ? DAY) THEN total ELSE 0 END) as overdue_60_plus,
                    SUM(total) as total
                ', [$days, $doubleDays, $days, $doubleDays])
                ->first();
        });

        return $this->success($aging);
    }

    public function export(Request $request)
    {
        $request->validate([
            'type' => 'required|in:revenue,invoices,payments',
            'start' => 'nullable|date',
            'end' => 'nullable|date|after:start',
        ]);

        $query = match($request->type) {
            'revenue' => Payment::where('status', 'completed'),
            'invoices' => Invoice::query(),
            'payments' => Payment::query(),
            default => Payment::query(),
        };

        if ($request->has('start')) {
            $query->where('created_at', '>=', $request->start);
        }

        if ($request->has('end')) {
            $query->where('created_at', '<=', $request->end);
        }

        return $this->success([
            'count' => $query->count(),
            'data' => $query->limit(100)->get(),
        ]);
    }
}