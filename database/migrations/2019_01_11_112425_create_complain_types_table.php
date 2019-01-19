<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplainTypesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('complain_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('complain_types');
    }
}
