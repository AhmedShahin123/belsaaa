<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeAddressNullableOnTaskerAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (db_driver() === 'mysql') {
            \DB::statement('alter table tasker_attributes modify address text null;');
        } elseif (db_driver() === 'sqlite') {
            Schema::table('tasker_attributes', function (Blueprint $table) {
                $table->text('address')->nullable()->change();
            });
        }
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
