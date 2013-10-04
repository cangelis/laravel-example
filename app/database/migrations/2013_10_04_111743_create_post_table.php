<?php

use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('post', function($table) {
                    $table->increments('id');
                    $table->timestamps();
                    $table->string('title');
                    $table->integer('user_id');
                    $table->text('content');
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('post');
    }

}