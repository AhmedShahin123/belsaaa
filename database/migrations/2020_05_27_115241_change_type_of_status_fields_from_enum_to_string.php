<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeOfStatusFieldsFromEnumToString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("alter table assignment_request_taskers modify status varchar(64) default 'pending' null;");
        \DB::statement("alter table assignment_requests modify status varchar(64) not null;");
        \DB::statement("alter table tasks modify status varchar(64) not null;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enum_to_string', function (Blueprint $table) {
            //
        });
    }
}
