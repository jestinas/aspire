<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_summaries', function (Blueprint $table) {
            $table->increments('loan_summaries_id');
            $table->integer('loan_id')->index();
            $table->integer('loan_amount');
            $table->float('total_paid', 10, 2);
            $table->float('interest_charged', 10, 2);
            $table->integer('balance_term');
            $table->date('last_payment_date')->nullable();
            $table->date('next_payment_date');
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
        Schema::dropIfExists('loan_summaries');
    }
}
