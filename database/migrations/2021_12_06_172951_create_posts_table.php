<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // auto-incrementing ID 
            $table->text('body');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // onDelete -> if we delete a user -> all users posts will be deleted from DB; Also added FK to user table
            $table->timestamps(); // creates values -> createdAt & updatedAt
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
