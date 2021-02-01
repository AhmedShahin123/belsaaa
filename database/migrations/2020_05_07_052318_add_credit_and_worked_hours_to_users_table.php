<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreditAndWorkedHoursToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasker_attributes', function (Blueprint $table) {
            $table->integer('worked_hours')->default(0)->after('hour_rate');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('credit')->default(0)->after('cellphone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('credit');
        });

        Schema::table('tasker_attributes', function (Blueprint $table) {
            $table->dropColumn('worked_hours');
        });
    }
}
