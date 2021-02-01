<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeBioAndHourRateOptional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (db_driver() == 'mysql') {
            DB::statement('alter table tasker_attributes modify bio text null;');
            DB::statement('alter table tasker_attributes modify hour_rate int null;');
        } elseif (db_driver() == 'sqlite') {
            Schema::table('tasker_attributes', function (Blueprint $table) {
                $table->text('bio')->nullable(true)->change();
                $table->text('hour_rate')->nullable(true)->change();
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
    }
}
