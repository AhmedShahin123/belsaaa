<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeEmployerAttributesNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("alter table employer_attributes modify address text null;");
        \DB::statement("alter table employer_attributes modify national_number varchar(191) null;");
        \DB::statement("alter table employer_attributes modify gender enum('male', 'female') null;");
        \DB::statement("alter table employer_attributes modify birth_date date null;");
        \DB::statement("alter table employer_attributes modify bio text null;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
