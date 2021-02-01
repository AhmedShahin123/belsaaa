<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentRequestTaskersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_request_taskers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('assignment_request_id')->index();
            $table->unsignedBigInteger('tasker_id')->index();
            $table->enum('status', ['pending', 'tasker_rejected', 'tasker_accepted', 'employer_rejected', 'employer_accepted']);
            $table->dateTime('status_updated_at');
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
        Schema::dropIfExists('assignment_request_taskers');
    }
}
