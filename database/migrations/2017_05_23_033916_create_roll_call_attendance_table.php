<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollCallAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_roll_call', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('roll_call_id')->unsigned()->nullable();
            $table->foreign('roll_call_id')->references('id')
                ->on('roll_calls')->onDelete('cascade');
            $table->integer('attendance_id')->unsigned()->nullable();
            $table->foreign('attendance_id')->references('id')
                ->on('attendances')->onDelete('cascade');
            $table->boolean('present')->default(false);
            $table->timestamps();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_roll_call');
    }
}
