<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTripIdForeignKeyToRollCall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roll_calls', function (Blueprint $table) {
            $table->integer('trip_id')->unsigned();
            $table->foreign('trip_id')
                ->references('id')
                ->on('trips')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roll_calls', function (Blueprint $table) {
            $table->dropForeign('roll_calls_trip_id_foreign');
            $table->dropColumn('trip_id');
        });
    }
}
