<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('task_id')->index();
            $table->unsignedBigInteger('employer_id')->index();
            $table->unsignedBigInteger('tasker_id')->index();
            $table->float('employer_amount')->default(0);
            $table->float('commission')->default(0);
            $table->float('tasker_amount')->default(0);
            $table->float('employer_must_pay')->default(0);
            $table->enum('payment_type', ['cash', 'online']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
