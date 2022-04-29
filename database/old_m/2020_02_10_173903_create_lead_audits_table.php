<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('project')->nullable();
            $table->string('created_on')->nullable();
            $table->string('lead_number')->nullable();
            $table->string('lead_stage')->nullable();
            $table->string('lead_source')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('url')->nullable();
            $table->string('lead_owner')->nullable();
            $table->string('lat_feedback')->nullable();
            $table->string('detailed_remark')->nullable();
            $table->string('lat_executive')->nullable();
            $table->string('lat_action')->nullable();
            $table->string('location')->nullable();
            $table->string('budget')->nullable();
            $table->string('configuration')->nullable();
            $table->string('property_type')->nullable();
            $table->string('completion_status')->nullable();
            $table->string('tat_is_high')->nullable();
            $table->string('improper_update_in_lms')->nullable();
            $table->string('no_update_in_lms')->nullable();
            $table->string('improper_pitching')->nullable();
            $table->string('missed_follow_up')->nullable();
            $table->string('using_unprofessional_terms')->nullable();
            $table->string('unprofessional_behavior')->nullable();
            $table->string('improper_opening_and_closing_of_the_call')->nullable();
            $table->string('no_recording_available_unable_to_validate')->nullable();
            $table->string('total_yes')->nullable();
            $table->string('audit_date')->nullable();
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
        Schema::dropIfExists('lead_audits');
    }
}
