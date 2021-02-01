<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaskersAcceptedAndEmployerTimeoutToAssignmentRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("alter table assignment_requests modify status enum('created', 'taskers_accepted', 'employer_timeout', 'closed', 'accepted', 'failed') not null;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assignment_requests', function (Blueprint $table) {
            //
        });
    }
}
