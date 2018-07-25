<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersHasFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_has_files', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('users_id');
            $table->uuid('files_id');
//            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('files_id')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_has_files');
    }
}
