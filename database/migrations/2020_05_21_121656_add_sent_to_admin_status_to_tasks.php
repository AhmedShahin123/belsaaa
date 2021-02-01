<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSentToAdminStatusToTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("alter table tasks modify status enum('new', 'initiate', 'selected_by_tasker', 'approved_by_employer', 'sending', 'accepted', 'started', 'finished', 'canceled', 'sent_to_admin') not null;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_status_to_tasks', function (Blueprint $table) {
            //
        });
    }
}
