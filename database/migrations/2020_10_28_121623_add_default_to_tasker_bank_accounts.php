<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultToTaskerBankAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasker_bank_accounts', function (Blueprint $table) {
            $table->boolean('default')->nullable();
            $table->unique(['tasker_attributes_id', 'default']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasker_bank_accounts', function (Blueprint $table) {
            $table->dropUnique(['tasker_attributes_id', 'default']);
            $table->dropColumn('default');
        });
    }
}
