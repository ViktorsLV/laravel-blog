<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsernameToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /* function to add a new column in the table. */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) { // specifying which table to add to
            $table->string('username'); // specifying how to call the column. After run -> php artisan migrate
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username'); //function for dropping the same column
        });
    }
}
