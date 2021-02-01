<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex('payments_invoice_id_index');
            $table->dropColumn('invoice_id');
        });

        Schema::create('invoice_payment', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id')->index();
            $table->unsignedBigInteger('payment_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id')->nullable()->index()->after('id');
        });

        Schema::dropIfExists('invoice_payment');
    }
}
