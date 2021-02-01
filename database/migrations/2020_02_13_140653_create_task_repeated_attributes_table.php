<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskRepeatedAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_repeated_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::create('task_repeated_days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('weekday', \App\Models\TaskRepeatedAttributes::WEEKDAYS);
            $table->time('start_time');
            $table->unsignedInteger('duration');
            $table->unsignedBigInteger('repeated_attributes_id')->index();
            $table->unique(['repeated_attributes_id', 'weekday']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_repeated_days');
        Schema::dropIfExists('task_repeated_attributes');
    }
}
