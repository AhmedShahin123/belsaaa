<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSendingAndAcceptedStatusToTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("alter table tasks modify status enum('new', 'initiate', 'selected_by_tasker', 'approved_by_employer', 'sending', 'accepted', 'started', 'finished', 'canceled') not null;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("alter table tasks modify status enum('new', 'initiate', 'selected_by_tasker', 'approved_by_employer', 'started', 'finished', 'canceled') not null;");
    }
}
