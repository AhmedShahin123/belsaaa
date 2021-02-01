<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartAndEndDateToTaskRepeatedAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_repeated_attributes', function (Blueprint $table) {
            if (db_driver() === 'mysql') {
                $table->date('start_date')->after('id');
                $table->date('end_date')->after('start_date');
            } elseif (db_driver() === 'sqlite') {
                $table->date('start_date')->default('0000-00-00 00:00:00')->after('id');
                $table->date('end_date')->default('0000-00-00 00:00:00')->after('start_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_repeated_attributes', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
    }
}
