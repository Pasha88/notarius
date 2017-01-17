<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarTable extends Migration
{

    public function up()
    {
        Schema::create('calendar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year')->nullable()->unsigned();
            $table->integer('month')->nullable()->unsigned();
            $table->integer('day')->nullable()->unsigned();
            $table->integer('busy')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calendar');
    }
}
