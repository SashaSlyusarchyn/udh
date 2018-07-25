<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersHasSecretTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_has_secret_types', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('users_id');
            $table->uuid('secret_types_id');
//            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('secret_types_id')->references('id')->on('secret_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_has_secret_types');
    }
}
