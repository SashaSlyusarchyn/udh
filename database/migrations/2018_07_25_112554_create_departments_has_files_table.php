<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsHasFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments_has_files', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('departments_id');
            $table->uuid('files_id');
//            $table->timestamps();
            $table->foreign('departments_id')->references('id')->on('departments');
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
        Schema::dropIfExists('departments_has_files');
    }
}
