<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('script_id');
            $table->string('client');
            $table->string('phone_number');
            $table->string('email');
            $table->json('answer');
            $table->json('disposition');
            $table->boolean('is_complete')->default(false);
            $table->dateTime('appointment_date');
            $table->dateTime('callback_date');
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
        Schema::dropIfExists('reports');
    }
}
