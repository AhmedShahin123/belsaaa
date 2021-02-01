<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cellphone')->nullable()->after('email');
            $table->string('verification_code')->after('remember_token')->nullable();
            $table->timestamp('phone_verified_at')->after('verification_code')->nullable();
            $table->timestamp('phone_verification_expires_at')->after('phone_verified_at')->nullable();
            $table->unique('cellphone');
        });

        DB::statement('update users set cellphone = uuid;');

        Schema::table('users', function (Blueprint $table) {
            $table->string('cellphone')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_cellphone_unique');
            $table->dropColumn('cellphone');
            $table->dropColumn('verification_code');
            $table->dropColumn('phone_verified_at');
            $table->dropColumn('phone_verification_expires_at');
        });
    }
}
