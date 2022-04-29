<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account_team')->nullable();
            $table->string('initiated_by')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('transaction_mode')->nullable();
            $table->string('platform')->nullable();
            $table->string('project')->nullable();
            $table->string('date')->nullable();
            $table->string('currency')->nullable();
            $table->string('amount')->nullable();
            $table->string('card_no')->nullable();
            $table->string('card_holder')->nullable();
            $table->string('transaction_verification')->nullable();
            $table->string('document')->nullable();
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
        Schema::dropIfExists('exp');
    }
}
