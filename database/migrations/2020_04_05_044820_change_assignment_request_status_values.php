<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAssignmentRequestStatusValues extends Migration
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
alter table assignment_requests
    modify status enum ('created', 'closed', 'accepted', 'failed') not null;
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
    }
}
