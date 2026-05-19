<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Client;
use Illuminate\Support\Facades\Cache;

class BillingService
{
    public function getDashboardStats(int $userId): array
    {
        $cacheKey = "billing_dashboard_{$userId}";
        
        return Cache::remember($cacheKey, 300, function () use ($userId) {
            $clients = Client::where('created_by', $userId)->pluck('id');
            
            $totalRevenue = Payment::whereIn('invoice_id', function ($query) use ($clients) {
                $query->select('id')
                    ->from('invoices')
                    ->whereIn('client_id', $clients);
            })
            ->where('status', 'completed')
            ->sum('amount') ?? 0;

            $pendingInvoices = Invoice::whereIn('client_id', $clients)
                ->where('status', 'pending')
                ->count();

            $overdueInvoices = Invoice::whereIn('client_id', $clients)
                ->where('status', 'pending')
                ->where('due_date', '<', now())
                ->count();

            $monthlyRevenue = Payment::whereIn('invoice_id', function ($query) use ($clients) {
                $query->select('id')
                    ->from('invoices')
                    ->whereIn('client_id', $clients);
            })
            ->where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount') ?? 0;

            return [
                'total_revenue' => $totalRevenue,
                'pending_invoices' => $pendingInvoices,
                'overdue_invoices' => $overdueInvoices,
                'monthly_revenue' => $monthlyRevenue,
            ];
        });
    }

    public function getRevenueChart(int $userId, int $days = 30): array
    {
        $clients = Client::where('created_by', $userId)->pluck('id');
        
        return Payment::whereIn('invoice_id', function ($query) use ($clients) {
            $query->select('id')
                ->from('invoices')
                ->whereIn('client_id', $clients);
        })
        ->where('status', 'completed')
        ->where('created_at', '>=', now()->subDays($days))
        ->selectRaw('DATE(created_at) as date, SUM(amount) as total')
        ->groupBy('date')
        ->orderBy('date')
        ->get()
        ->toArray();
    }

    public function getInvoiceStatusBreakdown(int $userId): array
    {
        $clients = Client::where('created_by', $userId)->pluck('id');
        
        return Invoice::whereIn('client_id', $clients)
            ->selectRaw('status, COUNT(*) as count, SUM(total_amount) as total')
            ->groupBy('status')
            ->get()
            ->toArray();
    }

    public function getClientRevenue(int $userId): array
    {
        $clients = Client::where('created_by', $userId)->get();
        
        return $clients->map(function ($client) {
            $revenue = $client->invoices()
                ->where('status', 'paid')
                ->sum('total_amount') ?? 0;
            
            return [
                'client_id' => $client->id,
                'client_name' => $client->name,
                'revenue' => $revenue,
            ];
        })->sortByDesc('revenue')->values()->toArray();
    }

    public function getOverdueInvoices(int $userId): \Illuminate\Database\Eloquent\Collection
    {
        $clients = Client::where('created_by', $userId)->pluck('id');
        
        return Invoice::with(['client'])
            ->whereIn('client_id', $clients)
            ->where('status', 'pending')
            ->where('due_date', '<', now())
            ->orderBy('due_date')
            ->get();
    }

    public function createInvoice(array $data): Invoice
    {
        $invoiceNumber = $this->generateInvoiceNumber();
        
        return Invoice::create([
            'invoice_number' => $invoiceNumber,
            'client_id' => $data['client_id'],
            'issue_date' => $data['issue_date'] ?? now(),
            'due_date' => $data['due_date'] ?? now()->addDays(30),
            'total_amount' => $data['total_amount'],
            'status' => 'pending',
            'notes' => $data['notes'] ?? null,
        ]);
    }

    public function markInvoicePaid(Invoice $invoice): Invoice
    {
        $invoice->update(['status' => 'paid']);
        
        Payment::create([
            'invoice_id' => $invoice->id,
            'amount' => $invoice->total_amount,
            'method' => 'manual',
            'status' => 'completed',
            'processed_at' => now(),
        ]);

        return $invoice;
    }

    private function generateInvoiceNumber(): string
    {
        $prefix = 'INV';
        $year = date('Y');
        $month = date('m');
        
        $lastInvoice = Invoice::where('invoice_number', 'like', "{$prefix}-{$year}{$month}%")
            ->orderBy('invoice_number', 'desc')
            ->first();

        $sequence = $lastInvoice 
            ? (int) substr($lastInvoice->invoice_number, -4) + 1 
            : 1;

        return sprintf('%s-%s%s-%04d', $prefix, $year, $month, $sequence);
    }
}