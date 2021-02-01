<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskerBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasker_bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('iban');
            $table->string('bank_name');
            $table->unsignedBigInteger('tasker_attributes_id')->index();
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
        Schema::dropIfExists('tasker_bank_accounts');
    }
}
