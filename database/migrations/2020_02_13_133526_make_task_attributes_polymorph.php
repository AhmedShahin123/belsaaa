<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeTaskAttributesPolymorph extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn([
                'start_date',
                'start_time',
                'end_date',
                'end_time',
            ]);

            $table->unsignedBigInteger("attributes_id")->nullable()->after('task_type');
            $table->index(["task_type", "attributes_id"]);
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
            $table->date('start_date')->nullable()->after('required_tasker_gender');
            $table->date('end_date')->nullable()->after('start_date');
            $table->time('start_time')->nullable()->after('end_date');
            $table->time('end_time')->nullable()->after('start_time');

            $table->dropIndex('tasks_task_type_attributes_id_index');
            $table->dropColumn('attributes_id');
        });
    }
}
