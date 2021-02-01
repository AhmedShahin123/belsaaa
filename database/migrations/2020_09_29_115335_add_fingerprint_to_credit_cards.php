<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFingerprintToCreditCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credit_cards', function (Blueprint $table) {
            $table->string('fingerprint')->nullable()->after('tap_card_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credit_cards', function (Blueprint $table) {
            $table->dropColumn('fingerprint');
        });
    }
}
