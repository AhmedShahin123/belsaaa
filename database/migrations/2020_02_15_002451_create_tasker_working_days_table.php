<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskerWorkingDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasker_working_days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('weekday', \App\Models\TaskRepeatedAttributes::WEEKDAYS);
            $table->boolean('shift_day');
            $table->boolean('shift_night');
            $table->unsignedBigInteger('tasker_attributes_id')->index();
            $table->unique(['weekday', 'tasker_attributes_id']);
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
        Schema::dropIfExists('tasker_working_days');
    }
}
