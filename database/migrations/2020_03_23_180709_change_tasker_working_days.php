<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTaskerWorkingDays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasker_working_days', function (Blueprint $table) {
            if (db_driver() === 'mysql') {
                $table->dropUnique('tasker_working_days_weekday_tasker_attributes_id_unique');
            }
            $table->dropColumn([
                'shift_day',
                'shift_night',
                'weekday',
            ]);
            $table->enum('shift', ['day', 'night'])->after('tasker_attributes_id')->nullable();
            $table->dateTime('date')->after('shift')->nullable();
            $table->time('start')->after('date')->nullable();
            $table->time('end')->after('start')->nullable();
            $table->unique(['date', 'tasker_attributes_id', 'shift']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasker_working_days', function (Blueprint $table) {
            $table->dropUnique('tasker_working_days_date_tasker_attributes_id_shift_unique');
            $table->dropColumn('shift');
            $table->dropColumn('start');
            $table->dropColumn('end');
            $table->dropColumn('date');
            $table->enum('weekday', \App\Models\TaskRepeatedAttributes::WEEKDAYS)->after('id')->nullable();
            $table->boolean('shift_day')->after('weekday')->default(false);
            $table->boolean('shift_night')->after('shift_day')->default(false);
            $table->unique(['weekday', 'tasker_attributes_id']);
        });
    }
}
