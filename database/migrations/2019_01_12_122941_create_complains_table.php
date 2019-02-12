<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplainsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('complains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('complain_code')->unique();
            $table->string('name');
            $table->string('id_number');
            $table->string('email');
            $table->text('description');
            $table->integer('complain_type_id')->unsigned();
            $table->foreign('complain_type_id')
                ->references('id')
                ->on('complain_types');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->integer('unit_id')->unsigned();
            $table->foreign('unit_id')
                ->references('id')
                ->on('units');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('complains');
    }
}
