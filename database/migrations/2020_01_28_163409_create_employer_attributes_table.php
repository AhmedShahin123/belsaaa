<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployerAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('address');
            $table->string('national_number');
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date');
            $table->text('bio');
            $table->string('commercial_email')->nullable();
            $table->string('commercial_business_industry')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employer_attributes');
    }
}
