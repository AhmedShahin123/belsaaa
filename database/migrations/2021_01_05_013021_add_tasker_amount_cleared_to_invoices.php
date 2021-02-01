<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaskerAmountClearedToInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->boolean('tasker_amount_cleared')->default(false)->after('tasker_amount_paid');
        });
        DB::statement('update invoices set tasker_amount_cleared = 1 where commission_paid = 0 and tasker_amount_paid = 1');
        DB::statement("update invoices set payment_type = 'online' where commission_paid = 1 and tasker_amount_paid = 1");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('tasker_amount_cleared');
        });
        DB::statement("update invoices set payment_type = 'cash'");
    }
}
