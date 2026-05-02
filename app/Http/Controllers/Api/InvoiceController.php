<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Invoice::with(['client:id,name', 'payments'])->orderBy('created_at', 'desc');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        $invoices = $query->paginate(20);
        return $this->success($invoices);
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'due_date' => 'nullable|date',
        ]);

        return DB::transaction(function () use ($request) {
            $subtotal = 0;
            $invoice = Invoice::create([
                'client_id' => $request->client_id,
                'invoice_number' => Invoice::generateNumber(),
                'status' => 'draft',
                'due_date' => $request->due_date ?? now()->addDays(30),
                'created_by' => $request->user()->id,
            ]);

            foreach ($request->items as $item) {
                $total = $item['quantity'] * $item['unit_price'];
                $subtotal += $total;
                
                $invoice->items()->create([
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total' => $total,
                ]);
            }

            $tax = $subtotal * ($request->tax_rate ?? 0) / 100;
            $discount = $request->discount ?? 0;
            $total = $subtotal + $tax - $discount;

            $invoice->update([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => $discount,
                'total' => $total,
            ]);

            return $this->success($invoice->load(['items', 'client']), 'Invoice created', 201);
        });
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['client', 'items', 'payments', 'createdBy:id,name']);
        return $this->success($invoice);
    }

    public function update(Request $request, Invoice $invoice)
    {
        if ($invoice->status !== 'draft') {
            return $this->error('Cannot edit non-draft invoice', 422);
        }

        $invoice->update($request->only(['due_date', 'notes']));
        return $this->success($invoice, 'Invoice updated');
    }

    public function send(Request $request, Invoice $invoice)
    {
        if ($invoice->status !== 'draft') {
            return $this->error('Invoice already sent', 422);
        }

        $invoice->update(['status' => 'sent', 'sent_at' => now()]);
        return $this->success(null, 'Invoice sent');
    }

    public function markPaid(Request $request, Invoice $invoice)
    {
        $invoice->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return $this->success(null, 'Invoice marked as paid');
    }

    public function cancel(Request $request, Invoice $invoice)
    {
        if (in_array($invoice->status, ['paid', 'cancelled'])) {
            return $this->error('Cannot cancel this invoice', 422);
        }

        $invoice->update(['status' => 'cancelled']);
        return $this->success(null, 'Invoice cancelled');
    }
}