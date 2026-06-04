<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            if (Schema::hasColumn('invoices', 'amount') && !Schema::hasColumn('invoices', 'total')) {
                $table->renameColumn('amount', 'total');
            }
        });

        Schema::table('invoices', function (Blueprint $table) {
            if (!Schema::hasColumn('invoices', 'invoice_number')) {
                $table->string('invoice_number')->nullable()->unique()->after('client_id');
            }
            if (!Schema::hasColumn('invoices', 'subtotal')) {
                $table->decimal('subtotal', 15, 2)->default(0)->after('client_id');
            }
            if (!Schema::hasColumn('invoices', 'tax')) {
                $table->decimal('tax', 15, 2)->default(0)->after('subtotal');
            }
            if (!Schema::hasColumn('invoices', 'discount')) {
                $table->decimal('discount', 15, 2)->default(0)->after('tax');
            }
            if (!Schema::hasColumn('invoices', 'sent_at')) {
                $table->timestamp('sent_at')->nullable()->after('due_date');
            }
            if (!Schema::hasColumn('invoices', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('sent_at');
            }
            if (!Schema::hasColumn('invoices', 'notes')) {
                $table->text('notes')->nullable()->after('paid_at');
            }
            if (Schema::hasColumn('invoices', 'description')) {
                $table->dropColumn('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            if (Schema::hasColumn('invoices', 'total') && !Schema::hasColumn('invoices', 'amount')) {
                $table->renameColumn('total', 'amount');
            }
        });
    }
};
