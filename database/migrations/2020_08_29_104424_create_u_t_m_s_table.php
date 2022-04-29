<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUTMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('project')->nullable();
            $table->string('campaign')->nullable();
            $table->string('url')->nullable();
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_term')->nullable();
            $table->string('utm_content')->nullable();
            $table->string('utm_adposition')->nullable();
            $table->string('utm_device')->nullable();
            $table->string('utm_network')->nullable();
            $table->string('utm_placement')->nullable();
            $table->string('utm_target')->nullable();
            $table->string('utm_ad')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('utm');
    }
}
