<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('name');
            $table->integer('complain_id')->unsigned();
            $table->foreign('complain_id')
                ->references('id')
                ->on('complains');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
