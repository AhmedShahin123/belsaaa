<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateToTaskRepeatedDays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_repeated_days', function (Blueprint $table) {
            $table->date('date')->after('id')->nullable();
            $table->dropColumn('duration');
            $table->time('end_time')->after('start_time')->nullable();
            $table->dropUnique('task_repeated_days_repeated_attributes_id_weekday_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_repeated_days', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('end_time');
            $table->integer('duration')->after('start_time')->nullable();
        });
    }
}
