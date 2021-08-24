<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('resume_id');
            $table->string('company_name');
            $table->string('title');
            $table->string('location');
            $table->integer('start_month');
            $table->integer('start_year');
            $table->integer('end_month')->nullable();
            $table->integer('end_year')->nullable();
            $table->string('currently_work');
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
        Schema::dropIfExists('jobs');
    }
}
