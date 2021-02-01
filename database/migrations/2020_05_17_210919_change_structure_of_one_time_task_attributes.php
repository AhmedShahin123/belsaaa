<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStructureOfOneTimeTaskAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('alter table task_one_time_attributes change start_at start_date date not null;');
        Schema::table('task_one_time_attributes', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->time('start_time')->default('00:00:00')->after('start_date');
            $table->time('end_time')->default('00:00:00')->after('start_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('alter table task_one_time_attributes change start_date start_at datetime not null;');
        Schema::table('task_one_time_attributes', function (Blueprint $table) {
            $table->integer('duration')->default(0)->after('start_at');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
        });
    }
}
