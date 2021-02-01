<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastRequestSentAtAndLastTaskerAcceptedAtToTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->timestamp('last_request_sent_at')->nullable()->after('canceled_by_id')->index();
            $table->timestamp('last_tasker_accepted_at')->nullable()->after('canceled_by_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropIndex('tasks_last_request_sent_at_index');
            $table->dropIndex('tasks_last_tasker_accepted_at_index');
            $table->dropColumn('last_request_sent_at');
            $table->dropColumn('last_tasker_accepted_at');
        });
    }
}
