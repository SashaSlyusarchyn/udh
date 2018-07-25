<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsHasFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations_has_files', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('organizations_id');
            $table->uuid('files_id');

            $table->foreign('organizations_id')->references('id')->on('organizations');
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
        Schema::dropIfExists('organizations_has_files');
    }
}
