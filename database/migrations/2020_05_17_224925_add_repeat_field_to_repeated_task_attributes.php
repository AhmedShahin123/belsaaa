<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRepeatFieldToRepeatedTaskAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_repeated_attributes', function (Blueprint $table) {
            $table->boolean('repeat')->default(false)->after('end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_repeated_attributes', function (Blueprint $table) {
            $table->dropColumn('repeat');
        });
    }
}
