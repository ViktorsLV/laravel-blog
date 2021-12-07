<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->mediumText('commentBody');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // onDelete cascade -> if we delete a user -> all users likes will be deleted from DB; Also added FK to user table
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // onDelete -> same with post deletion
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
        Schema::dropIfExists('comments');
    }
}
