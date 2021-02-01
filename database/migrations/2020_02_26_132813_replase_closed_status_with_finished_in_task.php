<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReplaseClosedStatusWithFinishedInTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (db_driver() === 'mysql') {
            $sql = <<<SQL
alter table tasks modify status enum('new', 'initiate', 'selected_by_tasker', 'approved_by_employer', 'started', 'finished', 'canceled') not null;
SQL;

            DB::statement($sql);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sql = <<<SQL
alter table tasks modify status enum('new', 'initiate', 'selected_by_tasker', 'approved_by_employer', 'started', 'closed', 'canceled') not null;
SQL;

        DB::statement($sql);
    }
}
