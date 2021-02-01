<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClosedToStatusEnumOnAssignmentRequestTaskers extends Migration
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
    alter table assignment_request_taskers modify status enum('pending', 'tasker_rejected', 'tasker_accepted', 'employer_rejected', 'employer_accepted', 'closed') default 'pending';
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
alter table assignment_request_taskers
    modify status enum ('pending', 'tasker_rejected', 'tasker_accepted', 'employer_rejected', 'employer_accepted') not null;
SQL;

        DB::statement($sql);
    }
}
