<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('project')->nullable();
            $table->string('channel')->nullable();
            $table->string('type')->nullable();
            $table->string('person')->nullable();
            $table->string('status')->nullable();
            $table->string('source')->nullable();
            $table->string('target_audience')->nullable();
            $table->string('budget_cost')->nullable();
            $table->string('actual_cost')->nullable();
            $table->string('expected_leads_count')->nullable();
            $table->string('actual_leads_count')->nullable();
            $table->string('invalid_leads_count')->nullable();
            $table->string('expected_site_visit_count')->nullable();
            $table->string('actual_site_visit_count')->nullable();
            $table->string('expected_sor')->nullable();
            $table->string('actual_sor')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('expected_close_sate')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('campaigns');
    }
}
