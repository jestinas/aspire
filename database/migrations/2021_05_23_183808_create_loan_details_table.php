<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_details', function (Blueprint $table) {
            $table->increments('loan_id');
            $table->integer('user_id')->index()->comment('User id from users table');
            $table->string('loan_application_id', 50)->index();
            $table->integer('loan_amount');
            $table->integer('loan_tenure');
            $table->float('interest');
            $table->integer('user_bank_id');
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
        Schema::dropIfExists('loan_details');
    }
}
