<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToRollCallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roll_calls', function (Blueprint $table) {
            $table->integer('attendance_id')->unsigned();
            $table->foreign('attendance_id')
                ->references('id')
                ->on('attendances')
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
            $table->dropForeign('roll_calls_attendance_id_foreign');
            $table->dropColumn('attendance_id');
        });
    }
}
