<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimoutToAssignmentRequestStatusValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
alter table assignment_request_taskers modify status enum('pending', 'tasker_rejected', 'tasker_accepted', 'tasker_timeout', 'employer_rejected', 'employer_accepted', 'employer_timeout', 'closed') default 'pending';
SQL;
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
