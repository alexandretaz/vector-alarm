<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeDeviceUniqueForUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devices', function (Blueprint $table) {

            $table->string('operator_imei')->nullable();
            $table->unique(['owner_id', 'imei']);
            $table->index('token');
            $table->index('authorized');

        });
        Schema::table('alarms', function (Blueprint $table) {

            $table->integer('device_id');
            $table->index(['device_id', 'client_id']);
            $table->index('closed_at');

        });
        Schema::table('helps', function (Blueprint $table) {

            $table->integer('device_id');
            $table->index(['device_id', 'client_id']);
            $table->index('closed_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn('operator_imei');
            $table->dropUnique(['owner_id','imei']);
            $table->dropIndex('token');
            $table->dropIndex('authorized');
        });
    }
}
