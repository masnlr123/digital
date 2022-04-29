<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsAgrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads_agrs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('created_on')->nullable();
            $table->string('lead_id')->nullable();
            $table->string('lead_no')->nullable();
            $table->string('lead_stage')->nullable();
            $table->string('lead_source')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('lead_owner')->nullable();
            $table->string('dump')->nullable();
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
        Schema::dropIfExists('leads_agrs');
    }
}
