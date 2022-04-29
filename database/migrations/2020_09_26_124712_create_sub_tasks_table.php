<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model')->nullable();
            $table->string('user_id')->nullable();
            $table->string('parent_id')->nullable();
            $table->string('name')->nullable();
            $table->string('activity')->nullable();
            $table->string('due_date')->nullable();
            $table->string('deliverable')->nullable();
            $table->string('status')->nullable();
            $table->string('duration')->nullable();
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
        Schema::dropIfExists('sub_tasks');
    }
}
