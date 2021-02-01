<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaskIdToAssignmentRequestTasker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assignment_request_taskers', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id')->after('id')->index();
            $table->unsignedBigInteger('assignment_request_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assignment_request_taskers', function (Blueprint $table) {
            $table->dropIndex('assignment_request_taskers_task_id_index');
            $table->dropColumn('task_id');
            $table->unsignedBigInteger('assignment_request_id')->nullable(false)->change();
        });
    }
}
