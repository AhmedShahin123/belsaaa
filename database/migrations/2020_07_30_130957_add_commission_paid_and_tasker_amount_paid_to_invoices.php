<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommissionPaidAndTaskerAmountPaidToInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->boolean('commission_paid')->default(false)->after('payment_type');
            $table->boolean('tasker_amount_paid')->default(false)->after('commission_paid');
            $table->dropColumn('paid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->boolean('paid')->default(false)->after('payment_type');
            $table->dropColumn('tasker_amount_paid');
            $table->dropColumn('commission_paid');
        });
    }
}
