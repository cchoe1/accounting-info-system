<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TransactionList', function (Blueprint $table) {
            $table->integer('transaction_id')->unsigned()->unique();
            $table->string('description');
            $table->string('date');
            $table->integer('number_of_transactions');
            $table->string('transaction_ids');
            $table->integer('invoice_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('invoice_id')->references('invoice_id')->on('Invoices');

            $table->primary('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TransactionList');
    }
}
