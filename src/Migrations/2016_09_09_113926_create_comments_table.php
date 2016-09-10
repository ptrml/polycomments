<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polycomments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('body');
            $table->integer('user_id')->index()->nullable();
            $table->boolean('deleted')->default(false);
            $table->morphs('comment');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polycomments');
    }
}
