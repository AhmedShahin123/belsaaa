<?php

use App\Models\Task;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaskTypeToTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            if (db_driver() === 'mysql') {
                $table->enum('task_type', ['one_time', 'repeated', 'continued'])->after('description');
            } elseif (db_driver() === 'sqlite') {
                $table->enum('task_type', ['one_time', 'repeated', 'continued'])->default('one_time')->after('description');
            }
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
            $table->dropColumn('task_type');
        });
    }
}
