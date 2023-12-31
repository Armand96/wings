<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_headers', function (Blueprint $table) {
            $table->primary(['document_code', 'document_number']);
            $table->string('document_code', 3);
            $table->string('document_number', 10);
            $table->string('user', 50);
            $table->double('total', null,null, true)->default(0);
            $table->date('date', 10);
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
        Schema::dropIfExists('transaction_headers');
    }
}
